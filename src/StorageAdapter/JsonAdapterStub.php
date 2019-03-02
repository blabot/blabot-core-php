<?php
declare(strict_types=1);

namespace Blabot\StorageAdapter;

use Blabot\StorageAdapter\StorageAdapterInterface;

class JsonAdapterStub implements StorageAdapterInterface
{
    public function loadIndex(): string
    {
        $index = "{
          \"cs\": {
            \"cs.json\": {
              \"name\": \"Modern Czech\",
              \"nameLocal\": \"Moderní čeština\",
              \"description\": \"Universal czech dictionary based on mix of several modern texts.\",
              \"descriptionLocal\": \"Univerzální český slovník vytvořený z několika moderních textů\",
              \"author\": \"Tomáš Kuba\",
              \"created\": \"2015-06-18 21:45:46\",
              \"updated\": \"2015-06-18 22:16:32\",
              \"language\": \"cs\"
            },
            \"cs-capek.json\": {
              \"name\": \"Čapek czech\",
              \"nameLocal\": \"Čapekovská čeština\",
              \"description\": \"Dictionary based on stories by Jarel Čapek\",
              \"descriptionLocal\": \"Slovník vygenerovaný z povídek Karla Čapka\",
              \"author\": \"Tomáš Kuba\",
              \"created\": \"2015-06-18 21:23:00\",
              \"updated\": \"2015-06-18 21:23:00\",
              \"language\": \"cs\"
            }
          }
        }";
        return $index;
    }

    public function loadDictionary($id): string
    {
        $dictionary = "{
          \"meta\": {
            \"name\": \"Dummy Czech\",
            \"nameLocal\": \"Hloupá čeština\",
            \"description\": \"Dummy test dictionary.\",
            \"descriptionLocal\": \"Hloupý český slovník\",
            \"author\": \"Tomáš Kuba\",
            \"created\": \"2019-02-23 16:25:00\",
            \"updated\": \"2019-02-23 16:25:00\",
            \"language\": \"cs\"
          },
          \"config\": {
            \"normalizingRules\": [
              [
                \" , \",
                \", \"
              ]
            ],
            \"badWords\": [
              \"kur\",
              \"píč\",
              \"čurá\",
              \"mrd\",
              \"srá\"
            ],
            \"specialWordChars\": \"-\",
            \"sentenceDelimiters\": \"!.?\"
          },
          \"words\": {
            \"1\": [
              \"a\"
            ],
            \"2\": [
              \"mi\"
            ],
            \"3\": [
              \"tun\"
            ],
            \"4\": [
              \"jako\"
            ],
            \"5\": [
              \"velký\"
            ]
          },
          \"sentences\": [
            \"<1> <2> <3>, <4> <5>.\",
            \"<5> <4>, <3> <2> <1>.\",
            \"<1> <5> <2> <4>.\"
          ]
        }
        ";
        return $dictionary;
    }
}