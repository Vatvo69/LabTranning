def find(arr,l,r,num):
  if r>=l:
    mid=(l+r)//2
    if arr[mid]==num:
      return mid
    elif arr[mid]>num:
      return find(arr,l,mid-1,num)
    else:
      return find(arr,mid+1,r,num)
  else:
    return -1
arr=[2,3,4,5,7,10,12,25,30]
num=int(input("Nhap so can tim: "))
i=find(arr,0,len(arr)-1,num)
if i==-1:
  print("Khong tim thay")
else:
  print(f"Tim thay {num} tai vi tri {i}")
