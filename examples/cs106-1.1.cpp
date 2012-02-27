#include <iostream>
using namespace std;

int main() {
    srand (4346);
    int headCount = 0, totalCount = 0;
    while(headCount < 3) {
        if(rand() % 2 == 0) {
            cout << "heads" << endl;
            headCount++;
        } else {
            cout << "tails" << endl;
            headCount = 0;
        }
        totalCount++;
    }
    cout << "It took " << totalCount << " flips to get 3 consecutive heads." << endl;
    return 0;
}
