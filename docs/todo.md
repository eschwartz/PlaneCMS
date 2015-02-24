# Todo

Currently working on getting a proof-of-concept together. It's setup now so that you can render *.md files from /content as html.
 
 Next on the agenda:
 
 - Setup some base test cases, so simulate HTTP requests. Use the Symfony crawler component if you can.
 - Write out some tests to cover basic rendering behavior.
 - Twig templates, with markdown content passed in
   - will need to think about template structure,
     ie, how does a dev define everything that belongs to a template?
         how are assets copied over into public/ dir?
         etc.
 
 That will give us the basic application behavior.
 After that:
 
 - Setup service locator. Allow plugins to be configured as services, etc.
 - Pass in useful context variables to templates (see what Pico or Jekyll does)
 - Parse markdown "front matter"
 
 Then on to build process stuff
 - Cache compiled HTML (maybe have a config to turn this off during dev)
 - Build tool for manually compiling static assets
 - Setup a proof-of-concept site, using Travis CI to build and deploy somewhere
   - Bonus points:
     Split out *.md content and assets into a separate repo. Travis CI
     script will need to pull the two repos together for the build.