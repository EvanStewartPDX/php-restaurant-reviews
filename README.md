# _Word Frequency

#### _A web page which suggests which coding track to take based on user inputs, September 15, 2016_

#### By _**Chris Martinez**_

## Description
_This page will search for word frequency._


## Specifications
| Behavior | Input Ex. | Output Ex. |
| --- | --- | --- |
|identify a single word as a match| phrase: "and" word: "and"|1|
|identify a word in a phrase| phrase: "bennie and the jets" word: "and"|1|
|identify a word regardless of capitalization |phrase: "And so we beat on" word: "and"|1|
|if a word is part of another word, it will not return a match| phrase: "andy williams" word:"and"| 0|
|ignore punctuation when making matches|phrase: "Yo! I ordered a latte!" word: "Yo"| 1|
|contains sample inputs with famous passages |ex: obama's second Inagural address word: "the"|103|
|gets average sentence length by separating input at ?! or .| "I am the walruss! Or Not."| 3|
|gets an approximate total of syllables by dividing characters by 3 (the average syllable length in English)|"I am the Walruss"|4 (actual is 5)|
|conducts Flesh Kincaid Readability test based on the 3 previous measurements|  | |



## Setup/Installation Requirements
* _Clone this repository to your desktop_
* _Run composer install from root_
* _Navigate to web folder and start local server_



## Link
https://github.com/cmartinez84/string-word-search

## Known Bugs
_None yet_

## Support and contact details
_cardamomclouds@yahoo.com_

## Technologies Used
_HTML,
CSS,
Bootstrap,
JS,
jQuery
PHP,
TWIG,
Silex_

### License
The MIT License (MIT)

Copyright (c) 2016 **_Chris Martinez_**
