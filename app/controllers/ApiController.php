<?php

class ApiController extends BaseController {

    public function healthCareCategory() {
        $category = [];
        foreach( Category::findBySlug('service/healthcare')->subCategories()  as  $post ) {
            $slug = $post->getSlug();
            $str = $slug;
            $str = preg_replace('/.*\//','',$str);
            $category[]=[
                'name'=>$post->translate()->name,
                'slug'=>$str
            ];
        }
        return $category;
    }

    public function healthCare()
    {
        $pn = Request::get('pn', 3);
        $data = [];
        foreach( Category::findBySlug('service/healthcare')->getPosts($pn)  as  $post ) {
            $data[]= [
                'title'=>$post->translate()->title,
                'content'=>$post->translate()->content];
        }
        return $data;

    }

    public function healthCareDetail($slug)
    {
        $usefulSlug = 'service/healthcare/'.$slug;
        $pn = Request::get('pn', 3);
        $data = [];
        foreach( Category::findBySlug($usefulSlug)->getPosts($pn)  as  $post ) {
            $data[]= [
                'title'=>$post->translate()->title,
                'content'=>$post->translate()->content];
        }
        return $data;
    }

    public function discount()
    {
        $data = [];

        foreach( Category::findBySlug('discount')->getPosts()  as  $post ) {
            $id = $post->getSlug();
            $str = $id;
            $str = preg_replace('/.*\//','',$str);
            $str = str_replace(array("_","post"),"",$str);
            $data[]= [
                'title'=>$post->translate()->title,
                'id'=>$str,
                'organization'=> $post->getMetaValue('organization', App::getLocale())];
        }
        return $data;
    }

    public function discountCategory()
    {
        $data = [];
        foreach (Category::findBySlug('discount')->subCategories() as $i=>$subcategory) {
            $a = $subcategory->translate()->name;

            foreach ($subcategory->subCategories() as $k=>$subsubcategory){
                $slug = $subsubcategory->getSlug();
                $str = $slug;
                $str = preg_replace('/.*\//','',$str);
                $data[$a][$k] = [
                    'name'=>$subsubcategory->translate()->name,
                    'slug'=>$str
                ];
            }
        }
        return $data;
    }
    public function discountDetail($id)
    {
        $data =[];
        $post  = Post::find($id);
        $discountImage = null;
        $address = null;
        $contact=null;
        $date = null;
        if($post->getMetaValue('discount_image', App::getLocale())){
            $discountImage = $post->getMetaValue('discount_image', App::getLocale());
        }
        if($post->getMetaValue('address', App::getLocale())){
            $address = $post->getMetaValue('address', App::getLocale());
        }
        if($post->getMetaValue('contact', App::getLocale())){
            $contact =$post->getMetaValue('contact', App::getLocale());
        }
        if($post->getMetaValue('date', App::getLocale())){
            $date = $post->getMetaValue('date', App::getLocale());
        }
        $data[]= [
            'title'=>$post->translate()->title,
            'createdAt'=>$post->getTranslatedCreatedAt(),
            'organization'=>$post->getMetaValue('organization', App::getLocale()),
            'discount'=>$post->getMetaValue('discount', App::getLocale()),
            'discountImage'=>$discountImage,
            'adress'=>$address,
            'contact'=>$contact,
            'date'=>$date
        ];
        return $data;
    }

    public function discountSlug($slug)
    {
        $data = [];
        foreach( Category::findBySlug('discount/'.$slug)->getPosts()  as  $post ) {
            $id = $post->getSlug();
            $str = $id;
            $str = preg_replace('/.*\//','',$str);
            $str = str_replace(array("_","post"),"",$str);
            $data[]= [
                'id'=>$str,
                'organization'=>$post->getMetaValue('organization', App::getLocale()),
                'title'=>$post->translate()->title,
            ];
        }
        return $data;
    }
    public function education()
    {
        $data = [];
        $pn = Request::get('pn', 10);
        foreach( Category::findBySlug('education/courses')->getPosts($pn)  as  $post ) {
            $id = $post->getSlug();
            $str = $id;
            $str = preg_replace('/.*\//','',$str);
            $str = str_replace(array("_","post"),"",$str);
            $data[]= [
                'id'=>$str,
                'title'=>$post->translate()->title,
                'duration'=>$post->getMetaValue('duration'),
                'fee'=>$post->getMetaValue('fee'),
                'quota'=>$post->getMetaValue('quota'),
                'start_at'=>$post->getMetaValue('start_at'),
                'lesson_time'=>$post->getMetaValue('lesson_time')


                ];
        }
        return $data;
    }
    public function educationCategory() {
        $category = [];
        foreach( Category::findBySlug('education/courses')->subCategories()  as  $post ) {
            $slug = $post->getSlug();
            $str = $slug;
            $str = preg_replace('/.*\//','',$str);
            $category[]=[
                'name'=>$post->translate()->name,
                'slug'=>$str
            ];
        }
        return $category;
    }

    public function educationDetail($id)
    {
        $data = [];
        $post  = Post::find($id);
        $data[]= [
            'title'=>$post->translate()->title,
            'createdAt'=>$post->getTranslatedCreatedAt(),
            'organization'=>$post->getMetaValue('organization') ? $post->getMetaValue('organization') : null,
            'detail'=>$post->getMetaValue('detail')?$post->getMetaValue('detail'):null ,
            'address'=>$post->getMetaValue('address')?$post->getMetaValue('address'):null,
            'start_at'=>$post->getMetaValue('start_at')?$post->getMetaValue('start_at'):null,
            'lesson_time'=>$post->getMetaValue('lesson_time')?$post->getMetaValue('lesson_time'):null,
            'language'=>$post->getMetaValue('language')?$post->getMetaValue('language'):null,
            'duration'=>$post->getMetaValue('duration')?$post->getMetaValue('duration'):null,
            'quota'=>$post->getMetaValue('quota')?$post->getMetaValue('quota'):null,
            'audience'=>$post->getMetaValue('audience')?$post->getMetaValue('audience'):null,
            'fee'=>$post->getMetaValue('fee')?$post->getMetaValue('fee'):null,
            'apply'=>$post->getMetaValue('apply')?$post->getMetaValue('apply'):null,
            'contact'=>$post->getMetaValue('contact')?$post->getMetaValue('contact'):null,
            'remark'=>$post->getMetaValue('remark') ? $post->getMetaValue('remark') : null,
            'content'=>$post->translate()->content ? $post->translate()->content : null
        ];
        return $data;
    }


    public function eventCategory()
    {
        $category = [
            //slug取值：art,health,finance,relationships,other
//            文化藝術  運動養生  退休理財  人際關係  其他
            [
                'name'=>'文化藝術',
                'slug'=>'art'
            ],
            [
                'name'=>'運動養生',
                'slug'=>'health'
            ],
            [
                'name'=>'退休理財',
                'slug'=>'finance'
            ],
            [
                'name'=>'人際關係',
                'slug'=>'relationships'
            ],
            [
                'name'=>'其他',
                'slug'=>'other'
            ]
        ];

//        foreach( Category::findBySlug('education/courses')->subCategories()  as  $post ) {
//            $slug = $post->getSlug();
//            $str = $slug;
//            $str = preg_replace('/.*\//','',$str);
//            $category[]=[
//                'name'=>$post->translate()->name,
//                'slug'=>$str
//            ];
//        }
        return $category;
    }
    public function event($slug)
    {
        $data = [];
        foreach( Category::findBySlug('event/'.$slug)->getPosts()  as  $post ) {
            $id = $post->getSlug();
            $str = $id;
            $str = preg_replace('/.*\//','',$str);
            $str = str_replace(array("_","post"),"",$str);
            $data[]= [
                'id'=>$str,
                'title'=>$post->translate()->title,
                'place'=>$post->getMetaValue('place'),
                'date'=>$post->getMetaValue('date'),
                'quota'=>$post->getMetaValue('quota'),
                'contact'=>$post->getMetaValue('contact'),
            ];
        }
        return $data;
    }

    public function eventDetail($id)
    {

        $data = [];
        $post  = Post::find($id);
        $data[]= [
            'title'=>$post->translate()->title,
            'createdAt'=>$post->getTranslatedCreatedAt(),
            'date'=>$post->getMetaValue('date')?$post->getMetaValue('date'):null,
            'place'=>$post->getMetaValue('place')?$post->getMetaValue('place'):null,
            'performer'=>$post->getMetaValue('performer')?$post->getMetaValue('performer'):null,
            'organization'=>$post->getMetaValue('organization')?$post->getMetaValue('organization'):null,
            'fee'=>$post->getMetaValue('fee')?$post->getMetaValue('fee'):null,
            'contact'=>$post->getMetaValue('contact')?$post->getMetaValue('contact'):null,
            'remark'=>$post->getMetaValue('remark')?$post->getMetaValue('remark'):null,
            'content'=>$post->translate()->content?$post->translate()->content:null
            ];
        return $data;

    }

    public function newsCategory()
    {
        $category = [];
        foreach( Category::findBySlug('news')->subCategories()  as  $post ) {
            $slug = $post->getSlug();
            $str = $slug;
            $str = preg_replace('/.*\//','',$str);
            $category[]=[
                'name'=>$post->translate()->name,
                'slug'=>$str
            ];
        }
        return $category;
    }

    public function newsSlug($slug)
    {
        $data = [];
        $pn = Request::get('pn', 3);
        foreach( Category::findBySlug('news/'.$slug)->getPosts($pn)  as  $post ) {
            $imageUrl = $post->getImageUrl()?$post->getImageUrl():null;
            $id = $post->getSlug();
            $str = $id;
            $str = preg_replace('/.*\//','',$str);
            $str = str_replace(array("_","post"),"",$str);
            $data[]= [
                'id'=>$str,
                'title'=>$post->translate()->title,
                'imageUrl'=>$imageUrl,
                'excerpt'=>$post->translate()->getExcerpt(),
                'start_at'=>$post->getTranslatedCreatedAt(),
            ];
        }
        return $data;
    }

    public function newsDetail($id)
    {
        $data = [];
        $post  = Post::find($id);
        $data[]= [
            'title'=>$post->translate()->title,
            'createdAt'=>$post->getTranslatedCreatedAt(),
            'imageUrl'=>$post->getImageUrl()?$post->getImageUrl():null,
            'content'=>$post->translate()->content
        ];
        return $data;
    }


    public function healthCategory()
    {
        $category = [];
        foreach( Category::findBySlug('health')->subCategories()  as  $post ) {
            $slug = $post->getSlug();
            $str = $slug;
            $str = preg_replace('/.*\//','',$str);
            $category[]=[
                'name'=>$post->translate()->name,
                'slug'=>$str
            ];
        }
        return $category;
    }

    public function healthSlug($slug)
    {
        $data = [];
        $page = Request::get('page', 1);
        $pn = Request::get('pn', 3);
        if($slug=='news'){
            foreach( Category::findBySlug('health/'.$slug)->getPosts($pn)  as  $post ) {
                $id = $post->getSlug();
                $str = $id;
                $str = preg_replace('/.*\//','',$str);
                $str = str_replace(array("_","post"),"",$str);
                $data[]= [
                    'id'=>$str,
                    'slug'=>$post->getSlug(),
                    'excerpt'=>$post->translate()->getExcerpt(),
                    'title'=>$post->translate()->title,
                ];
            }
            return $data;
        }

        elseif ($slug=='disease'){
            if(count( Category::findBySlug('health/'.$slug)->subCategories() )){
                foreach( Category::findBySlug(Category::findBySlug('health/'.$slug)->getFilteredSlug())->subCategories() as $posts_cat ){
                    $a =  $posts_cat->translate()->name;
                    foreach( Category::findBySlug('health/'.$slug)->getPosts($pn)  as $i=> $post ) {
                        $data[$a][$i]= [
                            'slug'=>$post->getSlug(),
                            'excerpt'=>$post->translate()->getExcerpt(),
                            'title'=>$post->translate()->title,
                        ];
                    }
                }
            }
            return $data;
        }
        elseif($slug=='info'){
            if ($page > 1) {
                return $data;
            }
            $data[]=[
                'title'=>Category::findBySlug('health/'.$slug)->getPage()->translate()->title,
                'content'=>Category::findBySlug('health/'.$slug)->getPage()->translate()->content
            ];
            return $data;
        }
        elseif($slug=='tips'){
            $data [] =[
                'title'=>'保健貼士',
                'content'=>[
                    [
                        'name'=>'保健短片',
                        'slug'=>'video'
                    ],
                    [
                        'name'=>'保健宣傳刊物',
                        'slug'=>'publication'
                    ],
                    [
                        'name'=>'衛生教育資源',
                        'slug'=>'resources'
                    ],
                    [
                        'name'=>'相關連結',
                        'slug'=>'links'
                    ],
                ]
            ];
            return $data;
        }elseif ($slug=='video'||'publication'||'resources'||'links'){
            if ($page > 1) {
                return $data;
            }
            $data[]=[
                'id' => Category::findBySlug('health/'.$slug)->getPage()->id,
                'title'=>Category::findBySlug('health/'.$slug)->getPage()->translate()->title,
                'content'=>Category::findBySlug('health/'.$slug)->getPage()->translate()->content,
            ];

            return $data;
//            return Category::findBySlug('health/'.$slug)->getPage()->translate();
        }
        else {
            return 2222;
        }

    }

    public function consultCategory()
    {
        $category = [];
        foreach( Category::findBySlug('consult')->subCategories()  as  $post ) {
            $slug = $post->getSlug();
            $str = $slug;
            $str = preg_replace('/.*\//','',$str);
            $category[]=[
                'name'=>$post->translate()->name,
                'slug'=>$str
            ];
        }
        return $category;
    }

    public function consultSlug($slug)
    {
        $page = Category::findBySlug('consult/'.$slug)->getPage();

        $data[] = [
            'title'=>$page->translate()->title,
            'content' => $page->translate()->content,
        ];
        return $data;
    }

    public function apiSlug($slug1, $slug2 = '', $slug3 = '', $slug4 = '')
    {
        //categories
        if ($slug2 == 'categories') {
            $categories = [];
            $category = Category::findBySlug($slug1);
            if (!count($category)) {
                return $categories;
            }

            foreach ($category->subCategories() as $post) {
                $categories[] = [
                    'name' => $post->translate()->name,
                    'slug' => $post->getSlug(),
                ];
            }
            return $categories;
        }
        if ($slug3 == 'categories') {
            $categories = [];
            $category = Category::findBySlug($slug1. '/'. $slug2);
            if (!count($category)) {
                return $categories;
            }

            if(!count($category->subCategories())) {
                $category = $category->getParentCategory();
            }

            foreach ($category->subCategories() as $post) {
                $categories[] = [
                    'name' => $post->translate()->name,
                    'slug' => $post->getSlug(),
                ];
            }
            return $categories;
        }
        if ($slug4 == 'categories') {
            $categories = [];
            $category = Category::findBySlug($slug1. '/'. $slug2. '/'. $slug3);
            if (!count($category)) {
                return $categories;
            }
            if(!count($category->subCategories())) {
                $category = $category->getParentCategory();
            }

            foreach ($category->subCategories() as $post) {
                $categories[] = [
                    'name' => $post->translate()->name,
                    'slug' => $post->getSlug(),
                ];
            }
            return $categories;
        }

        $data = [];
        $page = Request::get('page', 1);
        $pn = Request::get('pn', 3);

        $slug = trim($slug1. '/'. $slug2. '/'. $slug3, '/ ');
        $category = Category::findBySlug($slug);
        if (!count($category)) {
            return $data;
        }

        switch($category->type) {
            case 'page':
                if ($page > 1) {
                    return $data;
                }
                $data[] = [
                    'id' => $category->getPage()->id,
                    'title' => $category->getPage()->translate()->title,
                    'content' => $category->getPage()->translate()->content,
                ];
            break;
            case 'link':
            case 'post':
            default:
                foreach ($category->getPosts($pn)  as  $post) {
                    $data[]= [
                        'id' => $post->id,
                        'title' => $post->translate()->title,
                        'content' => $post->translate()->content,
                        'start_at' => $post->getTranslatedCreatedAt(),
                    ];
                }
            break;

        }

        return $data;
    }
}
