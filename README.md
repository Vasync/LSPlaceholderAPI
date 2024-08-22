# LSPlaceholderAPI
Placeholder for PocketMine-MP.

`Advice: if you use this branch, don't use the main branch!`
## 🤲How to use?
### Place it at the top of the file:
```PHP
use LootSpace369\lsplaceholderapi\PlaceHolderAPI;
```

### Example register Placeholder:
```PHP
$placeholder = "{hi}";
$replace = "hello";
PlaceHolderAPI::register($placeholder, $replace);
```
For example in text ui or string in more event enter {hi} it will output:
```
hello
```

### Example update Placeholder:
```PHP
PlaceHolderAPI::update("{hi}", "hi bro");
```
