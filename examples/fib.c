#include <stdio.h>

int fib(int i) {
  if(i <= 2) return 1;
  return fib(i - 1) + fib(i - 2);
}

int main() {
  int num;
  while(1) {
    scanf("%d", &num);
    if(num < 1) break;
    printf("fib(%d) = %d\n", num, fib(num)); 
  }
  return 0;
}
