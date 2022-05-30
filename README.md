![Alt text](images/ochin_logo.png?raw=true&=200x "ochin_web")
<h1>ochin_web - Template</h1>
<p>The "Template" software addon is designed to be a part of the <a href="https://github.com/ochin-space/ochin_web">ochin_web</a> project.
<p>This template was made to help develop new applications. It also has the purpose of defining a base line for the development of addons, in order to maintain the coherence between the pages as much as possible..<br>
Each Addon is embedded in ochin_web but is self-contained. Except for the topbar and some general libraries (jquery and bootstrap) which are part of the main framework, the addon contains everything it needs (specific libraries, databases, images etc ..)</p>
<p>

![Alt text](images/template.png?raw=true&=200x "Template")
<h3>What does this addon do</h3>
<p>This addon shows an example table. By means of the "+" button located at the top right of the same, it is possible to add a new empty row to the table. <br>
On the right side of each row there are two buttons: "Edit" and "Delete".

![Alt text](images/edit.png?raw=true&=200x "Edit") With the first button it is possible to insert and modify the data of the row, while with the second button it is possible to delete the entire row. <br>
All the data inserted in the table are written inside a sqlite3 database. It is created the first time the addon is started in the "db" subfolder. The table is updated at each page refresh requesting all the data from the database.</p>
<h3>The file structure of the Addon</h3>
&nbsp install.xml <br>
&nbsp info.html <br>
&nbsp index.php <br>
&nbsp icons <br>
&nbsp helper <br>
&nbsp &nbsp SQLiteConstructor.php <br>
&nbsp &nbsp init.php <br>
&nbsp &nbsp Config.php <br>
&nbsp db <br>
&nbsp &nbsp emptyTemplate.db <br>
&nbsp css <br>
&nbsp &nbsp loader.css <br>
<h4>info.html</h4>
Is the file in which this guide is contained.<br><br>
<h4>install.xml</h4>
It is the file by which the Addon manager is able to correctly load the Addon within the Framework. It is an XML file and it contains the following fields: <br>
&lt;install>
&nbsp &lt;addon name = 'Template'&gt; &nbsp &nbsp (the name of the addon)<br>
&nbsp &nbsp &lt;en&gt; true &lt;/en&gt; &nbsp &nbsp (enable addon by default)<br>
&nbsp &nbsp &lt;topbarpos&gt; Application &lt;/topbarpos&gt;&nbsp &nbsp (the position in the topbar)<br>
&nbsp &nbsp &lt;foldername&gt; template &lt;/foldername&gt; &nbsp &nbsp (the name of the folder, should be the same as the .zip)<br>
&nbsp &nbsp &lt;description&gt; addon template &lt;description> &nbsp &nbsp (a short description)<br>
&nbsp &lt;/addon&gt;<br>
&lt;/install><br><br>
<h4>index.php</h4>
It is the file that contains the main page of the addon. It is a .php file but it contains the HTML of the page, the Javascript to manage the client-side automation and the call to some PHP functions for database management.<br><br>
<h4>icons</h4>
It is the folder that contains the icons used by the Addon.<br><br>
<h4>helper</h4>
It is the folder that contains the helper files.<br><br>
<h4>SQLiteConstructor.php</h4>
It is the file that contains all the PHP code to manage the database. It contains the functions to create a new db, insert new tuples, edit their content, delete them etc ...<br><br>
<h4>init.php</h4>
It contains the initialization of the SQLiteConstructor class and includes the files necessary for the functioning of the Addon.<br><br>
<h4>config.php</h4>
Contains the paths to the folders used by the Addon.<br><br>
<h4>css</h4>
Contains style sheets. In this example, only the loader.css file is contained, which is used to display the "loader" when waiting for the page.<br><br>
