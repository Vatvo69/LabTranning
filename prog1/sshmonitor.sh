#!/bin/bash

who > new.txt
while read -r line;
do
  check=`grep -w "$line" -m 1 old.txt`
  if [ ! $check ];
  then
    echo -e "User" "`echo "$line" | awk '{print $1}'`" "dang nhap thanh cong vao thoi gian" "`echo "$line" | awk '{print $4}'`" "`echo "$line" | awk '{print $3}'`" > email.txt
  fi

done < new.txt
`sendmail root@localhost email.txt`
cat new.txt > old.txt