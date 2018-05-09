<h1>WEB DEVELOPMENT</h1>
<h3>WEBDEV Tools</h3>
<ul>
<li>Text Editor: <a href="https://www.sublimetext.com/3">Sublime</a></li>
<li>Terminal: <a href="https://git-scm.com/downloads">GitBash</a></li>
</ul>

<h3>Activity</h3>
<h4>Part 1: Github Setup</h4>
<ol>
 <li>Download all WEBDEV tools</li>	
 <li>Go to <a href="https://github.com/clydeinwebdev/decodeapp_heroku">https://github.com/clydeinwebdev/decodeapp_heroku</a></li>
 <li>Fork this repo 
  <br/>
  <img class="img-thumbnail"  src="https://github.com/clydeinwebdev/digitalSignage/blob/master/fork1.png" alt="fork"></li>
 <li>Then go to your Github Profile and verify if you have additional repo with the same name `decodeapp_heroku`</li>
 <li>Click the green button (<span style="color:green;">Clone</span>) and copy the displayed link<br/>
  <img class="img-thumbnail"  src="https://github.com/clydeinwebdev/digitalSignage/blob/master/clone.png" alt="fork">
 </li>
 <li>Use git bash and follow these commands
  <pre class="language-javascript">$ cd /d
$ git clone https://github.com/<span style="color:red;">yourgithubname</span>/decodeapp_heroku.git decodeapp-heroku<span style="color:red;">lastname</span>
$ cd decodeapp-heroku<span style="color:red;">lastname</span>
$ npm install

Note: Wait and this could take some time and this depends on the internet connection speed.

$ node server

Note: Go to your browser and type 'http://localhost:4000'
</pre>	
	</li>	
	<li>Verify if you have this page
	<br/><img class="img-thumbnail" src="https://github.com/clydeinwebdev/digitalSignage/blob/master/landingpage.png" alt="fork">
		<h5>This time change the following:</h5>
		<ul>
			<li>Page Title (change it to your <span style="color:red;">lastname</span>)</li>
			<li>Faveicon (look for any icon images and use it as your new faveicon)</li>
			<li>Nav color (see materializecss documentation <a href="http://materializecss.com/">here</a>)</li>
			<li>Footer color (see materializecss documentation <a href="http://materializecss.com/">here</a>) </li>
		</ul>
	</li>
</ol>

<h4>Part 2: Github Push</h4>
<ol>
	<li>Open another instance of git bash (Alt + F2) then change directory to the previous path
<pre class="language-javascript">$ cd /d/decodeapp-heroku<span style="color:red;">lastname</span>
$ git status
$ git add .
$ git config user.email "<span style="color:red">youremailaddress@gmail.com</span>"
$ git config user.name "<span style="color:red">yourgithubname</span>"
$ git commit -m "<span style="color:red">your commit message here</span>"
$ git push

Note: 

> Wait and this could take some time and this depends on the internet connection speed. 

> Remember to consider hosting/placing your files such like images and videos to
other web sites and just get the url of the file so that you will not have a 
loaded remote repo at github.

</pre>		

	</li>
	<li>If all files has been <span style="color:green">uploaded successfully</span>, then go to your github heroku repository and refresh the page. This time you must have successfully uploaded/push the files from your LOCAL 
repo to your REMOTE repo.</li>
</ol>

<h4>Part 3: Deploying to Heroku </h4>
<ol>
	<li>Download and Install Heroku Toolbelt (<a href="https://devcenter.heroku.com/articles/heroku-command-line#download-and-install">link here</a>)</li>

	<li>This time if you are using windows operating system, use command prompt (Start Menu -> Type "cmd") to setup heroku
<pre class="language-javascript">$ cd d:/decodeapp-heroku<span style="color:red;">lastname</span>
$ d:
$ heroku

Enter your Heroku credentials.
Email: <span style="color:red">youremailaddress@gmail.com</span>
Password (typing will be hidden):

Logged in as <span style="color:green">youremailaddress@gmail.com</span>
 !    Add apps to this dashboard by favoriting them with heroku apps:favorites:add
See all add-ons with heroku addons
See all apps with heroku apps --all

See other CLI commands with heroku help

</pre>	
	</li>

	<li>Modify your app.json
<pre class="language-javascript">{
  "name": "Node.js Getting Started",
  "description": "A sample app",
  "repository": "https://github.com/<span style="color:red;">yourgithubname</span>/decodeapp_heroku.git",
  "image": "heroku/nodejs"
}      
</pre>
	</li>

	<li>Create heroku
<pre class="language-javascript">$ heroku create decodeapp-heroku<span style="color:red;">lastname</span>

Creating decodeapp-heroku<span style="color:green;">lastname</span>... done
https://decodeapp-heroku<span style="color:green;">lastname</span>.herokuapp.com/ | https://git.heroku.com/decodeapp-heroku<span style="color:green;">lastname</span>.git

</pre>	
	</li>

	<li>Push your local repo to heroku
<pre class="language-javascript">$ git push heroku master

Counting objects: 64, done.
Delta compression using up to 4 threads.
Compressing objects: 100% (60/60), done.
Writing objects: 100% (64/64), 1.64 MiB | 33.00 KiB/s, done.
Total 64 (delta 0), reused 0 (delta 0)
remote: Compressing source files... done.
remote: Building source:
remote:
remote: -----> Node.js app detected

log messages hidden (too long!)

remote:
remote: -----> Compressing...
remote:        Done: 15.2M
remote: -----> Launching...
remote:        Released v3
remote:        https://decodeapp-heroku.herokuapp.com/ deployed to Heroku
remote:
remote: Verifying deploy... done.
To https://git.heroku.com/decodeapp-heroku.git
 * [new branch]      master -> master
</pre>	
	</li>

	<li>You may now go to https://decodeapp-heroku<span style="color:red;">lastname</span>.herokuapp.com/ to visit your live page</li>
</ol>


<h4>Part 4: Automatic Deploy</h4>
<ol>
	<li>Navigate to https://dashboard.heroku.com/apps then select <u><i>decodeapp-heroku<span style="color:red;">lastname</span> app </i></u></li>
	<li>Add Github to Heroku's pipeline
	<br/><img class="img-thumbnail" src="https://github.com/clydeinwebdev/digitalSignage/blob/master/addpipeline.png" alt="fork">
	</li>	
	<li>Connect to Github
	<br/><img class="img-thumbnail" src="https://github.com/clydeinwebdev/digitalSignage/blob/master/connectrepo.png" alt="fork">
	</li>	
	<li>Auto Deploy
	<br/><img class="img-thumbnail" src="https://github.com/clydeinwebdev/digitalSignage/blob/master/autodeploy.png" alt="fork">
	</li>	
	<li>Auto Deploy Branch
	<br/><img class="img-thumbnail" src="https://github.com/clydeinwebdev/digitalSignage/blob/master/autodeploybranch.png" alt="fork">
	</li>	
	<li>Verify
	<br/><img class="img-thumbnail" src="https://github.com/clydeinwebdev/digitalSignage/blob/master/autodeployresult.png" alt="fork">
	</li>
</ol>

<h4>Part 5: Apply Changes</h4>
<ol>
	<li>Apply any changes to your files</li>
	<li>Then follow these commands
<pre class="language-javascript">$ git add .
$ git commit -m "<span style="color:red">your commit message here</span>"
$ git push

Note: 

> Wait and this could take some time and this depends on the internet connection speed. 

> Remember to consider hosting/placing your files such like images and videos to
other web sites and just get the url of the file so that you will not have a 
loaded remote repo at github.
</pre>	

	</li>
	<li>Verify your LIVE app link hosted by heroku if changes has been applied.</li>
</ol>

##Done. Congratulations!!! :octocat:

###Hurray!! to the following students 🏆

* [Quisay](http://decodeapp-herokuquisaysa.herokuapp.com/)
* [Suarez](http://decodeapp-herokusuarez.herokuapp.com/)
* [Prajes](http://decodeapp-herokuprajes.herokuapp.com/)
* [Europa](http://decodeapp-herokueuropa.herokuapp.com/)
* [Nicolas](http://decodeapp-herokunicolas1.herokuapp.com/)
* [Hanoyan](http://decodeapp-herokuhanoyan.herokuapp.com/)

