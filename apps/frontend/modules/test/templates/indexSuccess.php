<?php use_stylesheet('grid'); ?>
<?php use_stylesheet('typography'); ?>

<h1>Index</h1>
<style>
    table{
        width: auto;
}

    table td{
        padding:3px;
        border: 1px solid #aaa;
        font-size: 13px;
        min-width: 40px;
}

strong{
    color: red;
}

</style>

<?php

/*
$search = "pari";
$culture = $sf_user->getCulture();

//Two arrays to hold the query and the values
$valeurs = array();
$arQuery = array();

$value1 = '%'. $search.'%';

//Code
//$tmpQuery = '(a.code LIKE ?) OR (a.airport LIKE ?) OR (t.name LIKE ?) OR (u.name LIKE ?)';
$tmpQuery = '(t.name LIKE ?) OR (a.code LIKE ?) OR (a.airport LIKE ?)';
array_push($arQuery, $tmpQuery);
array_push($valeurs, $value1);
array_push($valeurs, $value1);
array_push($valeurs, $value1);
//array_push($valeurs, $value1);

$query = implode(' OR ', $arQuery);

$this->datas = Doctrine::getTable('City')
                ->createQuery('a')
                ->select('a.code, a.airport AS airport, t.name AS name, b.id,  u.name AS country')
                ->leftJoin('a.Translation t')
                ->leftJoin('a.Country b')
                ->leftJoin('b.Translation u')
                ->andWhere('t.lang = ?',$culture)
                ->andWhere('u.lang = ?',$culture)
                //->andWhere($string,$values)
                ->andWhere($query,$valeurs)
                ->andWhere('a.cache = ?', true)
                ->andWhere('a.archived = ?', false)
                ->limit(25)
                ->addOrderBy('u.name')
                ->execute()
                ->toArray();

$results = array();

    foreach($this->datas as &$data){
        unset($data['Translation']);
        unset($data['Country']);
        unset($data['country_id']);
        unset($data['cache']);
        unset($data['state_id']);
        unset($data['metropolitan']);
        unset($data['archived']);
        $tmp = array(   'airport'=>$data['airport'],
                        'name'=>$data['name'],
                        'country'=>$data['country'],
                        'code'=>$data['code']);
        //$string  = $data['name'].', '.$data['country'].' ('.$data['code'].') '. $data['airport'];
        array_push($results, $tmp);
    }

var_dump($results);
 *
 * 
 */

//SELECT * FROM competition WHERE id NOT IN
//(SELECT id FROM competition ORDER BY score DESC LIMIT 19)
//ORDER BY score DESC LIMIT 10

$connect = mysql_connect('localhost', 'david', 'camper');
mysql_select_db('hyplexdemo');

$test = array(1=>'new y','lon u','san f','los a','pa ch','rom it','fr al', 'baha','Turks');


foreach ($test as $key=>$value) {




$search = $value;
$arSearch = explode(' ', $search);

$sql = "SELECT A.id, A.code, A.airport, B.name, C.name, D.code
FROM city AS A
LEFT JOIN city_translation AS C
ON A.id=C.id
LEFT JOIN country_translation AS B
ON A.country_id=B.id
LEFT JOIN state AS D
ON D.id=A.state_id
WHERE C.lang = 'en_US' AND  B.lang = 'en_US' ";

//$sql2 = " AND (C.name LIKE '%$search%' OR B.name LIKE '%$search%' OR A.airport LIKE '%$search%' OR A.code LIKE '%$search%')";

$sql2 = '';

foreach($arSearch as $value){
    $sql2 .= "AND (C.name LIKE '%$value%' OR B.name LIKE '%$value%' OR A.airport LIKE '%$value%' OR A.code LIKE '%$value%') ";
}

$sql3 = "
AND A.cache='1'
GROUP BY A.code
ORDER BY rank DESC
LIMIT 20
";

$sql .= $sql2.$sql3;

/*

$result = mysql_query($sql);
echo "<div class='span-12'><table>";

var_dump($arSearch);
echo "<br />";
while ($row = mysql_fetch_row($result)) {
    echo "</tr>";
    foreach($row as $r){
        foreach($arSearch as $value){
            $r = str_ireplace($value, '<strong>'.$value.'</strong>', $r);
        }
        echo "<td>". $r ."</td>";
    }
    echo "</tr>";
}
echo "</table></div>";


echo (fmod($key, 2) == 0 && $key != 0)? '<hr class="space3" /><hr />': '';
*/
}


$q = Doctrine::getTable('city')->searchAutoComplete();

var_dump($q);