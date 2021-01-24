<?php


namespace Modules\AddressBook\Repositories;


use Illuminate\Support\Facades\DB;
use Modules\AddressBook\Entities\ContactTag;
use Modules\AddressBook\Entities\Tag;

class TagsRepository
{
    public static function getTags($params)
    {
        $query = Tag::select('tags.id','tags.name',DB::raw('count(distinct contact_tags.contact_id) as contacts_count '))
            ->leftJoin('contact_tags','contact_tags.tag_id','=','tags.id')->groupBy('tags.id');

        $total_count = $query->get()->count();

        if (isset($params['search']) && $params['search']['value'] != '') {
            $search = $params['search']['value'];
            $query->whereLike(['tags.name'], $search);
        }

        if (!is_null($params['order']) && $params['order'] != '') {
            $ordering_array = [
                'name','contacts_cont'
            ];
            $ordering_direction = $params['order']['0']['dir'];
            $order_by = $params['order']['0']['column'];
            $query->orderBy($ordering_array[$order_by], $ordering_direction);
        }

        $this_count = $query->groupby('tags.id')->get()->count();

        if ($params['length'] != '-1') {
            $length = $params['length'];
            $start = $params['start'];
            $query->offset($start)->limit($length);
        }
        $tags = $query->get();
        return ['tags' => $tags, 'total_count' => $total_count, 'this_count' => $this_count];
    }

    public static function createTag(array $data)
    {
        $tag = new Tag();
        $tag->user_id = $data['user_id'];
        $tag->name = $data['name'];
        $tag->save();

    }

    public static function updateTag($tag,array $data)
    {
        $tag->name = $data['name'];
        $tag->save();
    }

    public static function checkTagsContacts($tag_id)
    {
        return ContactTag::where('tag_id',$tag_id)->count() > 0 ;
    }

    public static function deleteTag($tag)
    {
        $tag->delete();
    }
}
