<?php

namespace App\Utility;
class ProductUtility
{
    public static function get_attribute_options($collection)
    {
        $options = array();
        if (
            isset($collection['colors_active']) &&
            $collection['colors_active'] &&
            $collection['colors'] &&
            count($collection['colors']) > 0
        ) {
            $colors_active = 1;
            array_push($options, $collection['colors']);
        }

        if (isset($collection['choice_no']) && $collection['choice_no']) {
            foreach ($collection['choice_no'] as $key => $no) {
                $name = 'choice_options_' . $no;
                $data = array();
                foreach (request()[$name] as $key => $eachValue) {
                    array_push($data, $eachValue);
                }
                array_push($options, $data);
            }
        }

        return $options;
    }

    public static function get_specification_options($collection)
    {
        $options = array();

        if (isset($collection['specification_choice_no']) && $collection['specification_choice_no']) {
            foreach ($collection['specification_choice_no'] as $key => $no) {
                $name = 'specification_choice_options_' . $no;
                $data = array();
                if(!empty(request()[$name])) {
                    foreach (request()[$name] as $key => $eachValue) {
                        array_push($data, $eachValue);
                    }
                }
                array_push($options, $data);
            }
        }

        return $options;
    }

    public static function get_combination_string($combination, $collection)
    {
        $str = '';
        foreach ($combination as $key => $item) {
            if ($key > 0) {
                $str .= '-' . str_replace(' ', '', $item);
            } else {
                if (isset($collection['colors_active']) && $collection['colors_active'] && $collection['colors'] && count($collection['colors']) > 0) {
                    $color_name = Color::where('code', $item)->first()->name;
                    $str .= $color_name;
                } else {
                    $str .= str_replace(' ', '', $item);
                }
            }
        }
        return $str;
    }
}
