// function camelCaseConvert($name, $flag){
//     $newName = "";
//     $pattern = "/[\s,\/_\.\-;$\\\\]+/";
//     if($flag) $name = ucfirst($name);
//     for($i = 0; $i < strlen($name); $i++){
//         if(preg_match($pattern, $name[$i]) > 0  && preg_match("/^[A-Za-z]+$/", $name[$i+1]) > 0 && isset($name[$i+1])){
//             $name[$i+1] = strtoupper($name[$i+1]);
//         }
//     }
//     $newName = preg_replace($pattern, "", $name);
//     return $newName;
// }