<?php
/* -------------------------------------------------------------------------------------------------
 * File:    libs/Inflector.class.php
 * Version: 1.0
 * Desc:    manages the plurality of the english language
 * -------------------------------------------------------------------------------------------------
*/
namespace ControlAltKaboom\AppBase;

class Inflector {

static function pluralize ($word) {
   
   $plural_rules = array(
     '/(s)tatus$/i'             => '\1\2tatuses', # Rule:1
     '/^(ox)$/i'                => '\1\2en',      # Rule:2 ox
     '/([m|l])ouse$/i'          => '\1ice',       # Rule:3 mouse, louse
     '/(matr|vert|ind)ix|ex$/i' =>  '\1ices',     # Rule:4 matrix, vertex, index
     '/(x|ch|ss|sh)$/i'         =>  '\1es',       # Rule:5 search, switch, fix, box, process, address
     '/([^aeiouy]|qu)y$/i'      =>  '\1ies',      # Rule:6 query, ability, agency
     '/(hive)$/i'               =>  '\1s',        # Rule:7 archive, hive
     '/(?:([^f])fe|([lr])f)$/i' =>  '\1\2ves',    # Rule:8 half, safe, wife
     '/sis$/i'                  =>  'ses',        # Rule:9 basis, diagnosis
     '/([ti])um$/i'             =>  '\1a',        # Rule:10 datum, medium
     '/(p)erson$/i'             =>  '\1eople',    # Rule:11 person, salesperson
     '/(m)an$/i'                =>  '\1en',       # Rule:12 man, woman, spokesman
     '/(c)hild$/i'              =>  '\1hildren',  # Rule:13 child
     '/(buffal|tomat)o$/i'      =>  '\1\2oes',    # Rule:14 buffalo, tomato
     '/(bu)s$/i'                =>  '\1\2ses',    # Rule:15 bus
     '/(alias)/i'               =>  '\1es',       # Rule:16 alias
     '/(octop|vir)us$/i'        =>  '\1i',        # Rule:17 octopus, virus - virus has no defined plural (according to Latin/dictionary.com), but viri is better than viruses/viruss
     '/(ax|cri|test)is$/i'      =>  '\1es',       # Rule:18 axis, crisis
    '/s$/'                     =>  's',           # Rule:19  no change (compatibility)
    '/$/'                      =>  's'            # Rule:20  no change (compatibility)
    
    );

  foreach ($plural_rules as $rule => $replacement):
    if (preg_match($rule, $word)):
      return preg_replace($rule, $replacement, $word);
    endif;
  endforeach;

  return $word;
  
}
static function singularize ($word) {
  
  $singular_rules = array(
    '/(s)tatuses$/i'         => '\1\2tatus',
    '/(matr)ices$/i'         =>'\1ix',
    '/(vert|ind)ices$/i'     => '\1ex',
    '/^(ox)en/i'             => '\1',
    '/(alias)es$/i'          => '\1',
    '/([octop|vir])i$/i'     => '\1us',
    '/(cris|ax|test)es$/i'   => '\1is',
    '/(shoe)s$/i'            => '\1',
    '/(o)es$/i'              => '\1',
    '/(bus)es$/i'            => '\1',
    '/([m|l])ice$/i'         => '\1ouse',
    '/(x|ch|ss|sh)es$/i'     => '\1',
    '/(m)ovies$/i'           => '\1\2ovie',
    '/(s)eries$/i'           => '\1\2eries',
    '/([^aeiouy]|qu)ies$/i'  => '\1y',
    '/([lr])ves$/i'          => '\1f',
    '/(tive)s$/i'            => '\1',
    '/(hive)s$/i'            => '\1',
    '/([^f])ves$/i'          => '\1fe',
    '/(^analy)ses$/i'        => '\1sis',
    '/((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i' => '\1\2sis',
    '/([ti])a$/i'            => '\1um',
    '/(p)eople$/i'           => '\1\2erson',
    '/(m)en$/i'              => '\1an',
    '/(c)hildren$/i'         => '\1\2hild',
    '/(n)ews$/i'             => '\1\2ews',
    '/s$/i'                  => '');

  foreach ($singular_rules as $rule => $replacement):
    if (preg_match($rule, $word)):
      return preg_replace($rule, $replacement, $word);
    endif;
  endforeach;
  
  // should not return false is not matched
  return $word;
  
}

static function camelize($lower_case_and_underscored_word) {
  return str_replace(" ","",ucwords(str_replace("_", " ", $lower_case_and_underscored_word)));
}
static function underscoreFromCamel($camel_cased_word) {
  $camel_cased_word = preg_replace('/([A-Z]+)([A-Z])/', '\1_\2', $camel_cased_word);
  //return $camel_cased_word;
  return strtolower(preg_replace('/([a-z])([A-Z])/', '\1_\2', $camel_cased_word));
}
static function underscoreFromHuman($human_string) {
  return strtolower(str_replace(" ", "_", $human_string));
}
static function humanize($lower_case_and_underscored_word) {
  return ucwords(str_replace("_", " ", $lower_case_and_underscored_word));
}



static function condition($word, $cond=1) {

  return ($cond > 1 || $cond == 0) ? self::pluralize($word) : self::singularize($word);
  
}      
} // Inflector

?>
