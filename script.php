require 'instagram.class.php';
 
$instagram = new Instagram(array(
  'apiKey'      => $_SERVER["insta_key"],
  'apiSecret'   => $_SERVER["insta_secret"];
));

$token = $_SERVER["oauth_token"];
$instagram->setAccessToken($token);
$tag = "coffee waffles chicken tea"; // tags the script will go through
$tags = explode(' ', $tag);
foreach($tags as $key) {
	$media = $instagram->getTagMedia($key);

	foreach ($media->data as $data) {
		$id = $data->id;
		$result = $instagram->likeMedia($id);
 
		if ($result->meta->code === 200) {
			$n = $n + 1;
		  echo "<a href=\"{$data->link}\"><img src=\"{$data->images->thumbnail->url}\"></a>";
		} else { $i = $i + 1; echo $result->meta->error_message ."<br />"; }
	}
	 
}

if ($n) echo $n ." liked";
if ($i) echo $i ." voided";
