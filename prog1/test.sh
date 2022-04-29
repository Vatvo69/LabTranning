#!/bin/bash

touch old.txt new.txt mail.txt

who > new.txt
while read -r line
do
	check=$(grep -w "$line" -m 1 old.txt) 
	echo $check
	if [ ! $check ]
	then
		echo -e "User" "$(echo "$line" | awk '{print $1}')" "dang nhap thanh cong vao thoi gian" "$(echo "$line" | awk '{print $4}') $(echo "$line" | awk '{print $3}')" > mail.txt
	fi
done < new.txt
$(sendmail root@localhost mail.txt)
cat new.txt > old.txt 