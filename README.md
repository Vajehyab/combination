Combination
=============

Combination algorithm for **typo (misspelling) in Arabic and Persian language**. This can do even more and more just by changing the algorithm, just let me know what you need.


What is combination?
====================
In mathematics, a combination is a way of selecting items from a collection, such that (unlike permutations) the order of selection does not matter. In smaller cases it is possible to count the number of combinations. [(read more)](https://en.wikipedia.org/wiki/Combination)


I need to test this function more then your feedbacks are appreciated, please [fill an issue](https://github.com/m-kermani/combination/issues)
for any bugs you find or any suggestions you have.


How does this function sort returned values (array)? 
======================
I used the levenshtein function to sort the array, the Levenshtein algorithm (also called Edit-Distance or Levenshtein distance) is a string metric for measuring the difference between two sequences. Informally, the Levenshtein distance between two words is the minimum number of single-character edits (i.e. insertions, deletions or substitutions) required to change one word into the other.
It calculates the least number of edit operations that are necessary to modify one string to obtain another string.[read more](http://www.levenshtein.net/)


How to use this function?
=======
```php
  $array_1 = combination ($your_word);
 
 //Sorting by Levenshtein distance
 $array_2 =  combination($your_word, 'levin');
 
 
```
[Demo](http://balit.ir/hossein/combination.php)
=======
