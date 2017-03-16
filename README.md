# ECSA Default Theme

## Installation

```
git clone https://github.com/MfN-Berlin/ECSA-Theme.git
npm install
bower install
```

## Bourbon

Added bourbon support

http://bourbon.io
```
bower install bourbon --save
```

## Neat

Added neat support

http://neat.bourbon.io/
```
bower install neat --save
```


## Bitter structure

Default bitter structure

http://bitters.bourbon.io/

## Refills

http://refills.bourbon.io/

# Gulp Tasks

## default

```
gulp
```
- sass 
- concat js ( scripts/**/*.js , bower_components/**/*.js )
- concat css ( **/*.css )
- watch

## dist

```
gulp dist
```

Building minified sources and add bless support (IE)

## Add fontawesome

```
bower install fontawesome --save
```

Starting 
```
gulp
```

## Add singularity

```
bower install singularity --save
gulp
```

```
@import "breakpoint";
@import "singularitygs";
```
## Add semantic UI

In <theme>.info File

```
[gulp.css]
paths[] = 'semantic-ui/dist/components'

[gulp.js]
paths[] = 'semantic-ui/dist/components'
```

Install 

```
bower install semantic-ui --save
```

Start

```
gulp
```