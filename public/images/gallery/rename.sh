#!/bin/bash

for files in */*.csv
do
	sed -i 's/Colecci�n/Coleccion/g' "$files"
done
