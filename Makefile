.PHONY: phpdoc-install
phpdoc-install:
	@echo "Installing phpDocumentor..."
	curl -Lo phpDocumentor.phar https://github.com/phpDocumentor/phpDocumentor/releases/download/v3.4.3/phpDocumentor.phar

.PHONY: phpdoc-generate
phpdoc-generate:
	rm -Rf .phpdoc
	@echo "Generating phpDocumentor documentation..."
	php phpDocumentor.phar run -d ./src -t phpdoc --setting=graphs.enabled=true
	@echo "phpdoc/index.html"

.PHONY: ruby-install
ruby-install:
	@echo "Installing Ruby dependencies..."
	bundle install

.PHONY: jekyll-serve
jekyll-serve:
	@echo "Building Jekyll site..."
	bundle exec jekyll serve -s ./docs/