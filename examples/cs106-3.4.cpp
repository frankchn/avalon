#include <iostream>
#include <vector>
using namespace std;

int cutstock(vector<int> v, int remainder, int length) {
    if(v.size() == 0) return 0;
    
    int min = 9999999;
    for(int i = 0; i < v.size(); i++) {
        int r;
        vector<int> u = v;
        u.erase(u.begin() + i);
        if(remainder < v[i])
            r = cutstock(u, length - v[i], length) + 1;
        else 
            r = cutstock(u, remainder - v[i], length);
        min = (r < min) ? r : min;
    }
    return min;
}

int cutstock(vector<int> v, int length) {
    return cutstock(v, 0, length);
}

int main() {
    vector<int> v;
    int x;
  
    while(1) {
        cin >> x;
        if(x == 0) break;
        v.push_back(x);
    }
    
    cout << "I need " << cutstock(v, 10) << " pieces of stock." << endl;
    return 0;
}
