
var interface = {};

interface.elements = {};

interface.info = {};
interface.info.currentPage = "home";

interface.shortcuts = function()
{
	var shortcuts = "";
	shortcuts += "<div id=\"shortcuts\">";
		shortcuts += "<img class=\"shortcut\" src=\"img/icon1.png\" />";
		shortcuts += "<img class=\"shortcut\" src=\"img/icon2.png\" />";
		shortcuts += "<img class=\"shortcut\" src=\"img/icon3.png\" />";
	shortcuts += "</div>";
	return shortcuts;
}

interface.navigate = function(data)
{
	if (interface.info.menuOpened == 1)
		interface.menu();
	interface.info.currentPage = data.page;
	interface.render();
}

interface.pageTitle = function(data)
{
	var pageTitle = "";
	pageTitle += "<div id=\"page-title\">";
		pageTitle += "<div id=\"page-title-name\"> > " + data.title + "</div>";
		pageTitle += "<div id=\"page-title-user\">" + interface.data.profile.firstname + "'s Lists</div>";
	pageTitle += "</div>";
	return pageTitle;
}

interface.info.menuOpened = 0;
interface.info.menuOperating = 0;

interface.menu = function()
{
	if (interface.info.menuOpened == 0 && interface.info.menuOperating == 0)
	{
		//alert('open');
		interface.info.menuOperating = 1;
		document.getElementById('menu').style.display = "block";
		document.getElementById('menu').className = "animateFromRight";
		//document.getElementById('menu').className = "";
		document.getElementById('mainView').className = "blurred";
		document.getElementById('footer').className = "blurred";
		interface.info.menuOpened = 1;
		setTimeout(function(){interface.info.menuOperating = 0;}, 700);
	}
	else if (interface.info.menuOpened == 1 && interface.info.menuOperating == 0)
	{
		//alert('close');
		interface.info.menuOperating = 1;
		document.getElementById('menu').className = "animateFromLeft";
		document.getElementById('mainView').className = "";
		document.getElementById('footer').className = "";
		//document.getElementById('menu').className = "blurred";
		interface.info.menuOpened = 0;
		setTimeout(function(){document.getElementById('menu').style.display = "none"; interface.info.menuOperating = 0;}, 700);
		
	}
}

interface.compose = function(data)
{
	var elementHtml = "";
	if (data.element == "menu")
	{
		elementHtml += "<div class=\"button\" onclick=\"interface.navigate({'page':'home'})\">Home</div>";
		elementHtml += "<div class=\"button\" onclick=\"interface.navigate({'page':'list-history'})\">My Lists</div>";
		elementHtml += "<div class=\"button\" onclick=\"interface.navigate({'page':'account'})\">Account</div>";
		elementHtml += "<div class=\"button\" onclick=\"interface.navigate({'page':'settings'})\">Settings</div>";
		elementHtml += "<div class=\"button\" onclick=\"interface.navigate({'page':'whoweare'})\">whoweare</div>";
	}
	else if (data.element == "menu-bar")
	{
		elementHtml += "<div class=\"left\">";
			elementHtml += "<div id=\"logo\" onclick=\"interface.navigate({'page':'home'})\"></div>";
		elementHtml += "</div>";
		elementHtml += "<div class=\"right\">";
			elementHtml += "<div id=\"menu-caller\" onclick=\"interface.menu()\"></div>";
		elementHtml += "</div>";
	}
	else if (data.element == "mainView")
	{
		if (interface.info.currentPage == "home")
		{
			elementHtml += interface.pageTitle({title:'Home'});
			elementHtml += "<h2>You can write your new Smart List here</h2>";
			elementHtml += interface.shortcuts();
		}
		else if (interface.info.currentPage == "settings")
		{
			elementHtml += interface.pageTitle({title:'Settings'});
			elementHtml += "MySmartList Settings";
		}
		else if (interface.info.currentPage == "whoweare")
		{
			elementHtml += interface.pageTitle({title:'Who We Are !'});
			elementHtml += "Who we are";
		}
		else if (interface.info.currentPage == "account")
		{
			elementHtml += interface.pageTitle({title:'Account'});
			elementHtml += "Account Page";
		}
		else if (interface.info.currentPage == "list-history")
		{
			elementHtml += interface.pageTitle({title:'My Saved Lists'});
			elementHtml += "My Last Lists";
			elementHtml += interface.shortcuts();
		}
	}
	else if (data.element == "footer")
	{
		elementHtml += "<div>Hackathon Carrefour by BeMyApp 2016 &copy; - MySmartList &copy;</div>";
	}
	return elementHtml;
}

interface.render = function()
{
	interface.elements.menu = interface.compose({element:'menu'});
	interface.elements.menuBar = interface.compose({element:'menu-bar'});
	interface.elements.mainView = interface.compose({element:'mainView'});
	interface.elements.footer = interface.compose({element:'footer'});
	interface.update();
}

interface.update = function()
{
	document.getElementById('menu').innerHTML = interface.elements.menu;
	document.getElementById('menu-bar').innerHTML = interface.elements.menuBar;
	document.getElementById('mainView').innerHTML = interface.elements.mainView;
	document.getElementById('footer').innerHTML = interface.elements.footer;
}

interface.construct = function()
{
	var menu = document.createElement("div");
	menu.id = "menu";
	menu.style.display = "none";
	document.body.appendChild(menu);
	var menuBar = document.createElement("div");
	menuBar.id = "menu-bar";
	document.body.appendChild(menuBar);
	var mainView = document.createElement("div");
	mainView.id = "mainView";
	document.body.appendChild(mainView);
	var footer = document.createElement("div");
	footer.id = "footer";
	document.body.appendChild(footer);
	//Init rendering
	interface.render();
}



interface.data = {
	"profile": {
		"firstname": "Henri",
		"lastname": "Lumière",
		"birthdate": "20-10-1985",
		"sexe": "male",
		"avatar": "avatar.jpg",
		"lists": [{
			"dateCreation": "23-09-2016",
			"shared": "0",
			"price": 4.77,
			"products": [{
				"id": "044016223",
				"name": "Haricots Verts",
				"price": 0.98,
				"img": "haricots.jpg"
			}, {
				"id": "049849681",
				"name": "Shampoing l'Oréal",
				"price": 2.48,
				"img": "shampoing.jpg"
			}, {
				"id": "098465665",
				"name": "Café Décaféiné",
				"price": 2.31,
				"img": "cafe.jpg"
			}]
		}]
	}
};