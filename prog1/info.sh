#!/bin/bash

array=(
  "Ten May: `cat /etc/hostname`"
  # Ten nha phan khoi
  "Ten Ban Phan Phoi: `lsb_release -a | grep -w "Description:" | cut -d: -f2`"
  # Ten He dieu hanh
  "Phien Ban He Dieu Hanh: `lsb_release -a | grep -w "Release:" | cut -d: -f2`"
  # Ten CPU
  "Ten CPU: `cat /proc/cpuinfo | grep -w "model name" | cut -d ":" -f2 | head -1`"
  "Bit CPU: `lscpu | grep -w "Architecture" | cut -d ":" -f2`"
  "Toc Do CPU: `lscpu | grep -w "CPU MHz" | cut -d ":" -f2`"

  #Thong so bo nho vat li
  "Dung luong o cung: `df -h /dev/mapper/kalilinux20204--vg-home --output=size | grep "G"`"
  "Dung luong con lai: `df -h /dev/mapper/kalilinux20204--vg-home --output=avail | grep "G"`"

  # Danh sach dia chi IP cua he thong
  "Danh sach dia chi IP: `hostname -I`"

  # Danh sach user
  "Danh sach user: `cut -d: -f1 /etc/passwd | sort`"

  # Thong tin cac tien trinh dang chay voi quyen root
  "Danh sach cac tien trinh chay voi quyen root: `ps -fU root | awk '{print $8}'| sort`"

  "Thong tin cac port dang moi: `netstat -ltnp| awk '{print $4}' | sort -n`"

  "Danh sach cac thu muc tren he thong cho phep other co quyen ghi: `find -perm -o=r`"

  "Danh sach cac pham mem duoc cai dat tren he thong: `apt list --installed | cut -d/ -f1`"
)

echo "[Thong Tin He Thong]"
for i in ${!array[@]};
do
  echo ${array[$i]}
done
