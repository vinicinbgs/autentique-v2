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
	bundle exec jekyll serve -s ./docs/ -l

.PHONY: test
test:
	@echo "Running tests..."
	composer run test

.PHONY: test-coverage
test-coverage:
	@echo "Running tests with coverage..."
	composer run test-coverage

.PHONY: contribute
contribute:
	@echo "Running contribute..."
	sh ./contribute.sh