# fireworkweb/fwd

[![Build Status](https://travis-ci.com/fireworkweb/fwd.svg?branch=php)](https://travis-ci.com/fireworkweb/fwd)
[![codecov](https://codecov.io/gh/fireworkweb/fwd/branch/php/graph/badge.svg)](https://codecov.io/gh/fireworkweb/fwd)

## Installation

```bash
curl -L https://github.com/fireworkweb/fwd/raw/php/builds/fwd -o /usr/local/bin/fwd
chmod +x /usr/local/bin/fwd
```

## Usage

```bash
fwd install
fwd start
fwd composer install
fwd artisan migrate:fresh --seed
fwd yarn install
fwd yarn dev
fwd down
```

### docker-compose

```bash
# view containers logs
fwd docker-composer logs
# follow containers logs
fwd docker-composer logs 
```

### mysql

```bash
# connect to mysql server
fwd mysql
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


# Troubleshooting, common problemns, known limitations

### **fwd start timeout on first service**

Check if you can access docker without elevated privileges. [Follow this docker post-install](https://docs.docker.com/install/linux/linux-postinstall/).