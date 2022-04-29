#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <shadow.h>
#include <unistd.h>
int main(){
  FILE *f=fopen("/etc/shadow","r");
  FILE *f1=fopen("/opt/change.tmp","w");

  char *currentUser=getenv("USER");
  printf("Login voi User: %s\n",currentUser);

  struct spwd *spwd = getspnam(currentUser);
  char *password;

  password=getpass("Nhap password: ");

  char *encrypted=crypt(password,spwd->sp_pwdp);
  if(strcmp(encrypted,spwd->sp_pwdp)!=0){
    printf("Login Khong Thanh Cong!\n");
    return -1;
  }

  password=getpass("Sua password: ");

  encrypted=crypt(password,spwd->sp_pwdp);
  spwd->sp_pwdp=encrypted;

  if(f==NULL){
    printf("Khong Mo Duoc File f!\n");
    return -1;
  }
  if(f1==NULL){
    printf("Khong Mo Duoc File f1!\n");
    return -1;
  }
  char *read;
  size_t len=0;
  while(getline(&read,&len,f)!=-1){
    if(strstr(read,currentUser)){
      putspent(spwd,f1);
    }
    else{
      fputs(read,f1);
    }
  }
  remove("/etc/shadow");
  rename("/opt/change.tmp","/etc/shadow");
  printf("===Sua Thanh Cong===\n");
  fclose(f1);
  fclose(f);
}