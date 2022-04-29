#include <stdio.h>
#include <sys/types.h>
#include <pwd.h>
#include <stdlib.h>
#include <grp.h>

int main(){
  char name[100];
  printf("Nhap Username: ");
  scanf("%s",name);
  
  struct passwd *pwd;
  pwd=getpwnam(name);
  if(pwd == NULL){
    printf("Khong ton tai\n");
    return -1;
  }

  int groupId=0;
  getgrouplist(pwd->pw_name,pwd->pw_gid,NULL,&groupId);
  gid_t groups[groupId];

  getgrouplist(pwd->pw_name,pwd->pw_gid,groups,&groupId);

  printf("===Thong tin===\n");
  printf("Id: %u\n",pwd->pw_uid);
  printf("Username: %s\n",pwd->pw_name);
  printf("Thu muc home: %s\n",pwd->pw_dir);
  printf("Cac group cua user: ");
  for(int i=0;i<groupId;i++){
    printf("%s ",getgrgid(groups[i])->gr_name);
  }
  printf("\n");
}
