<?php

namespace App\Http\Controllers\Frontend\Modules;

use App\Models\Page;
use App\Http\Requests;
use Illuminate\Http\Request;
use Yangqi\Htmldom\Htmldom;

class ArticleController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $page = Page::where('id', session('page_id'))->first();
        $parser = new Htmldom($page->content);
//        $parser->load($page->content);
        $modify_html = '';


        $rows = $parser->find('div.row[data-section=true]');

        $add_class_to_wrapper = array();

        foreach ($rows as $item) {
            // Add wrapper class
            $wrapper_class = $item->getAttribute('data-custom-wrapper-class');
            if ($wrapper_class != false) {
                $add_class_to_wrapper[] = $wrapper_class;
            }


            // Add custom section class
            $add_class_to_section = array();
            $section_class = $item->getAttribute('data-custom-section-class');
            if ($section_class != false) {
                $add_class_to_section[] = $section_class;
            }

            // Add animation class
            $animate_class = $item->getAttribute('data-animation-class');
            if ($animate_class != false) {
                $add_class_to_section[] = 'wow';
                $add_class_to_section[] = $animate_class;
            }

            // Parallax image
            $parallax_image = $item->getAttribute('data-section-parallax');


            // Add container class
            $add_class_to_container = array();
            $container_class = $item->getAttribute('data-container-class');
            if ($container_class != false) {
                $add_class_to_container[]  = $container_class;
            }

            // Add custom container class
            $custom_container_classes = $item->getAttribute('data-custom-container-class');
            if ($custom_container_classes) {
                $add_class_to_container[] = $custom_container_classes;
            }


            $modify_html .= $this->addContainer($item, $add_class_to_section, $add_class_to_container, $parallax_image);
        }


        $wrapper_content = '<div';

        //check if wrapper class avaliable
        if (!empty($add_class_to_wrapper)) {
            $wrapper_content .= ' class=" '. implode(' ', $add_class_to_wrapper).'"';
        } else {
            $wrapper_content .= ' class=" '. implode(' ', $add_class_to_wrapper).'"';
        }

        $wrapper_content .= '>'.$modify_html.'</div>';


        $page->content = $wrapper_content;

//        dd($page->content);
        $form = strpos($page->content, '[form]');
        if($form != false){
            $form_temp = view('templates.frontend.modules.contact.basic');
            $form_html = $form_temp->render();
            $page->content = str_replace('[form]', $form_html, $page->content);
        }
        $view = view('templates.frontend.modules.article.list', compact('page'));
        return $view->render();
    }




    private function addContainer($item, $section_classes = array(), $container_class = array(), $parallax_section = '')
    {
        $html = '<section class="site-content ';

        // parallax class define

        if(!empty($parallax_section)){
            $html .= 'parallax_section ';
        }

        //Section class set
        $html .= $this->renderClass($section_classes);
        $html .= '"';
        $html .= ' data-wow-delay=".5s"';

        if(!empty($parallax_section)){
            $html .= 'style="background-image:url('.$parallax_section.')" ';
        }

        $html .= '><div class="container';

        //Section class set
        $html .= $this->renderClass($container_class);

        $html .= '">';
        $html .= $item;
        $html .= '</div></section>';
        return $html;
    }

    private function renderClass($classes = array())
    {
        $html ='';
        if (!empty($classes)) {
            $count = count($classes);
            foreach ($classes as $class) {
                $html .= ' '.$class;

                $lastItem = !(--$count); // it will give you boolean value. if lastItem is true then add space
                if (!$lastItem) {
                    $html .= ' ';
                }
            }
        }
        return $html;
    }


    public function showStaticContent(){
        $page = Page::find(session('page_id'));
        $view = view('templates.frontend.modules.home.static',compact('content', $page->content));
        return $view;
    }

    public function getContent(){
        $page = Page::find(session('page_id'));
        return $page->content;
    }

    public function getextraContent(){
        $page = Page::find(session('page_id'));
        $extra_content = $page->extra_content;

        if(!empty($extra_content)){
            return \GuzzleHttp\json_decode($extra_content);
        }else{
            return '';
        }
    }
}
