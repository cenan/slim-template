#!/bin/bash

echo "" > public/js/templates.js
for f in public/hbs/*.hbs
do
	handlebars --min $f >> public/js/templates.js
	echo ";" >> public/js/templates.js
done
