//Strpos for array:
function strposa($haystack, $needle, $offset=0) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $query) {
        if(mb_strpos($haystack, $query, $offset) !== false) return true;
    }
    return false;
}



//substr_count for array:
function substr_count_a( $haystack, $needle ) {
    $count = 0;
    foreach ($needle as $substring) {
        $count += mb_substr_count( $haystack, $substring);
    }
    return $count;
}


function mb_substr_replace($original, $replacement, $position, $length)
{
    $startString = mb_substr($original, 0, $position, "UTF-8");
    $endString = mb_substr($original, $position + $length, mb_strlen($original), "UTF-8");
    $out = $startString . $replacement . $endString;
    return $out;
}


//The main function 
function combination($word, $sort=false){
    mb_internal_encoding("UTF-8");
    $new_word_array[]=$word;

    /***
    @ var:
    ls: letters
    ol: one letter
    l:  letter
     */
    $ls[0]=[
        'ز',
        'ض',
        'ظ',
        'ذ'
    ];
    $ls[1]=[
        'ت',
        'ط'
    ];
    $ls[2]=[
        'ه',
        'ح'
    ];
    $ls[3]=[
        'غ',
        'ق',
    ];
    $ls[4]=[
        'س',
        'ص',
        'ث',
    ];

    $loop=0;
    $types_count=1;
    $count_similiars_in_word=0;

    foreach($ls as $lskey => $l){
        //Look up if this word has any of these letters ($l):
        if(strposa($word, $l)){
            $loop++;
            $count_similiars_in_word=substr_count_a($word, $l);
            foreach($l as $replace_l){
                foreach($l as $second_replace_l){
                    foreach($new_word_array as $new_word){
                        $new_word_array[]= str_replace($replace_l, $second_replace_l, $new_word );
                        $new_word_array=array_unique($new_word_array);
                    }

                }

            }

            for($i1=0; $i1<$count_similiars_in_word; $i1++){
                //For example when there are two gh in word, for will works (loop) 2 times:
                $types_count*=count($l);
                for($i2=0;$i2<$count_similiars_in_word; $i2++){
                    // number of times ($type_count)
                    $current_l=current($l);
                    next($l);

                    $start_pos=-1;
                    for($i3=0; $i3<$count_similiars_in_word; $i3++){
                        //h search in word after start pos
                        if(!empty($current_l)){
                            $start_pos=mb_strpos($word, $current_l, $start_pos+1);
                            if($start_pos){
                                foreach($l as $replace_l){
                                    foreach($new_word_array as $n_word){
                                        $new_word_array[]=mb_substr_replace($n_word, $replace_l, $start_pos, 1);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    $new_word_array=array_unique($new_word_array);
    if(count($new_word_array)==$types_count){
        if($sort==false){
            return $new_word_array;
        }else if($sort=='levin'){
            $loop_lev=0;
            $temp_arr=[]; $sorted_arr=[];
            foreach($new_word_array as $new_word_key => $new_word){
                $loop_lev++;
                $temp_arr[$new_word_key] = levenshtein($word,$new_word);
            }
            asort($temp_arr);
            foreach($temp_arr as $k => $v) {
                $sorted_arr[] = $new_word_array[$k];
            }
            return $sorted_arr;
        }

    }else{
        return false;
    }
}

//Test function:
$word = 'دغدغه';

    $i=combination($word);
    
    //See result here:
    print_r($i);
    
?>
