#!/bin/bash

for files in */*.JPG
do
	mv "$files" "${files%.JPG}.jpg"
done
