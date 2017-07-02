<?php

namespace App\Models;

use Baum\Node;
use App\Models\CompanyDetail;
use Illuminate\Support\Facades\Request;

class Page extends Node
{
    protected $fillable = [
        'heading',
        'excerpt',
        'content',
        'extra_content',
        'slug',
        'template',
        'child_template',
        'protected',
        'active',
        'on_main_nav'
    ];

    public $featureImage;

    /**
     * Set the slug.
     *
     * @param  string  $value
     * @return string
     */
    public function setSlugAttribute($value)
    {
        if ($value != 'home_do_not_set') {
            $this->attributes['slug'] = str_slug($value);
        }
    }

    public function getContentAttribute($value)
    {
        if (Request::segment(1) == 'admin') {
            return $value;
        }

        $company_details = CompanyDetail::find(1);

        return str_replace('##COMPANYNAME##', $company_details->name, $value);
    }

    public function extra()
    {
        return $this->hasOne(PageExtra::class);
    }

    public function banners()
    {
        return $this->belongsToMany(Banner::class, 'page_banners');
    }

    public function images()
    {
        return $this->belongsToMany(Media::class, 'page_images');
    }


    public function documents()
    {
        return $this->belongsToMany(Media::class, 'page_documents');
    }

    public function meta()
    {
        return $this->hasOne(PageMeta::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeCurrent($query)
    {
        return $query->where('id', session('page_id'));
    }

    public function scopeCurrentRoot($query)
    {
        $url = \Request::path();

        $explodedUrl = explode('/', $url);

        $urlArray = array();

        $indexCounter = 0;

        foreach ($explodedUrl as $segment) {
            $indexCounter++;
            $urlArray[$indexCounter] = $segment;
        }

        $slug = $urlArray[1];
        //$depth_key = key($urlArray);

        return $query->where('depth', 1)->where('slug', $slug);
    }

    public function getGrandparent($id){
        $page = $this->find($id);
        if(is_null($page)){
            return false;
        }
        if(in_array($page->parent_id, config('cms.image_tab_pages'))){
            return true;
        }else{
            return false;
        }
    }
}
