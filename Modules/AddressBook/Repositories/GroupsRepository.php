<?php


namespace Modules\AddressBook\Repositories;


use Illuminate\Support\Facades\DB;
use Modules\AddressBook\Entities\Contact;
use Modules\AddressBook\Entities\Group;

class GroupsRepository
{
    public static function getGroups($params)
    {
        $query = Group::select('groups.id','groups.name','groups.description',DB::raw('count(distinct contacts.id) as contacts_count '))
            ->leftJoin('contacts','contacts.group_id','=','groups.id')->whereNull('contacts.deleted_at')->groupby('groups.id');

        $total_count = $query->get()->count();

        if (isset($params['search']) && $params['search']['value'] != '') {
            $search = $params['search']['value'];
            $query->whereLike(['groups.name'], $search);
        }

        if (!is_null($params['order']) && $params['order'] != '') {
            $ordering_array = [
                 'name','contacts_cont'
            ];
            $ordering_direction = $params['order']['0']['dir'];
            $order_by = $params['order']['0']['column'];
            $query->orderBy($ordering_array[$order_by], $ordering_direction);
        }

        $this_count = $query->get()->count();

        if ($params['length'] != '-1') {
            $length = $params['length'];
            $start = $params['start'];
            $query->offset($start)->limit($length);
        }
        $groups = $query->get();
        return ['groups' => $groups, 'total_count' => $total_count, 'this_count' => $this_count];
    }

    public static function createGroup(array $data)
    {
        $group = new Group();
        $group->user_id = $data['user_id'];
        $group->name = $data['name'];
        $group->description = isset($data['description']) ? $data['description'] : null;
        $group->save();

    }

    public static function updateGroup($group,array $data)
    {
        $group->name = $data['name'];
        $group->description = isset($data['description']) ? $data['description'] : null;
        $group->save();
    }

    public static function checkGroupContacts($group_id)
    {
        return Contact::where('group_id',$group_id)->count() > 0 ;
    }

    public static function deleteGroup($group)
    {
        $group->delete();
    }
}
