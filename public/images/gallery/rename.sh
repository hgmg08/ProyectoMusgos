#!/bin/bash

for files in */*.csv
do
	sed -i 's/Colección/Coleccion/g' "$files"
done
