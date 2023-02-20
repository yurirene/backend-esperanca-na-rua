Abra Terminal.
Crie um clone bare do repositório.
$ git clone --bare https://github.com/exampleuser/old-repository.git
Faça espelhamento/push no novo repositório.
$ cd old-repository
$ git push --mirror https://github.com/exampleuser/new-repository.git
Remova o repositório local temporário que você criou anteriormente.
$ cd ..
$ rm -rf old-repository

talvez seja necess�rio
whereis composer
composer: /usr/bin/composer.phar /usr/local/bin/composer
php -dmemory_limit=-1 /usr/bin/composer.phar update