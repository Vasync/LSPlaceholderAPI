# LSPlaceholderAPI
Placeholder for PocketMine-MP.

## 🤲How to use?
Place it at the top of the file:
```PHP
use LootSpace369\lsplaceholderapi\PlaceHolderAPI;
```

Place this is in main:
```PHP
PlaceHolderAPI::init($this);
```

Example register Placeholder:
```PHP
$placeholder = "{hi}";
$replace = "hello";
PlaceHolderAPI::register($placeholder, $replace);
```
For example in text ui enter {hi} it will output:
```
hello
```

Example update Placeholder:
```PHP
PlaceHolderAPI::update("{hi}", "hi bro");
```
