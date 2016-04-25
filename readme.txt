to run steh included stut viewer, you have to
copy the following code to your nginx config:

----------------------------------------------------------------

### artothek settings
location ^~ /editor/preview_export/ {
	rewrite ^.*/editor/preview_export/(.*) /wp-content/themes/Vertex-child/exposition/preview_export/$1 last;
}
location ^~ /editor/css/ {
	rewrite ^.*/editor/css/(.*) /wp-content/themes/Vertex-child/exposition/preview_export/css/$1 last;
}