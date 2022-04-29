#!/bin/bash

createFile(){
	if [ ! -e $1 ]
	then 
		sudo touch $1;
		sudo chmod 777 $1 
	fi
}

checkTextFile(){
	check=`file -i $1 | grep -w "text/plain"`
	if [ "$check"==true ];
	then
		echo `head -n 10 $1` 
	else
		echo "ERROR"
	fi	
}

checkNewFile(){
	old=$1
	current=$2
	while read -r line;
	do 
		check=`grep -w $line -m 1 $old`
		
		echo $line
		if [[ ! $check && -f $line ]]
		then
			checkTextFile $line
		fi
	done < $current 
}

checkEditFile(){
	old=$1
	current=$2

}

checkDeleteFile(){
	old=$1
	current=$2
	while read -r line;
	do
		check=`grep -w $line -m 1 $old`
		if [ ! $check ];
		then
			checkTextFile $line
		fi
	done < $old
}

echo "[Log checketc - `date +%T` `date +%D`]"
dir="/etc"
listCheck="/opt/checkFile"
listCurrent="/opt/currentFile"
listOld="/opt/oldFile"

createFile $listCheck
createFile $listCurrent
createFile $listOld

`find /etc > $listCurrent`
`find /etc -cmin -30 > $listCheck`

echo "===Danh Sach File Tao Moi==="
checkNewFile $listOld $listCheck

# echo "===Danh Sach File Sua Doi==="
# editFile=`find /etc -mmin -30 | sed 's/ /\n/g'`
# echo $editFile

# echo "===Danh Sach File Bi Xoa==="
# checkDeleteFile $listOld $listCurrent
# `cat $listCurrent > $listOld`
