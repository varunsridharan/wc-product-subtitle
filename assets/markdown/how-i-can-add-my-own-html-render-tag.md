**Just follow the steps below**

1. Register Your Tag

2. Use `wc_ps_subtitle_{tag_slug}` action to render your own tag

#### Example Code

``` 
add_filter("wc_ps_tags","register_custom_tag"); // Filter To Register your Custom Tag

/**
 * @param $tags Array of Existing Tags.
 */
function register_custom_tag($tags){
	$tags["tag_slug"] = "Tag Name";
	return $tags;
}

add_action("wc_ps_subtitle_tag_slug","render_custom_tag"); // Action To Render Subtitle Tag

/**
 * @param $title Product’s Subtitle
 * @param $tag Call back Tag
 * @param $pid Current Product ID
 * @param $defaults is array of default class & id for the element
 */
function render_custom_tag($title,$tag,$pid,$defaults) {
	echo $title;
}
```
