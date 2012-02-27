#include <stdio.h>

int main() {
  char* a = malloc(30);
  for(int i = 0; i < 26; i++) {
     a[i] = 'A' + i; 
  }
  a[26] = 0;
  printf("%s\n", a);
  for(int i = 0; i < 26; i++) {
     a[25 - i] =  'A' + i;
  }
  printf("%s\n", a);
  return 0;
}

					
