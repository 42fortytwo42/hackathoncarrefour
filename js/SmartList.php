
var interface = {};

interface.elements = {};

interface.info = {};
interface.info.currentPage = "home";

interface.navigate = function(data)
{
	if (interface.info.menuOpened == 1)
		interface.menu();
	interface.info.currentPage = data.page;
	interface.render();
}

interface.info.menuOpened = 0;
interface.menu = function()
{
	if (interface.info.menuOpened == 0)
	{
		//open menu
		document.getElementById('menu').style.display = "block";
		interface.info.menuOpened = 1;
	}
	else
	{
		//close menu
		document.getElementById('menu').style.display = "none";
		interface.info.menuOpened = 0;
	}
}

interface.compose = function(data)
{
	var elementHtml = "";
	if (data.element == "menu")
	{
		elementHtml += "<div class=\"button\" onclick=\"interface.navigate({'page':'home'})\">Home</div>";
		elementHtml += "<div class=\"button\" onclick=\"interface.navigate({'page':'account'})\">Account</div>";
		elementHtml += "<div class=\"button\" onclick=\"interface.navigate({'page':'setting'})\">Setting</div>";
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
			elementHtml += "My Smart List :";
		}
		else if (interface.info.currentPage == "setting")
			elementHtml += "MySmartList Settings";
		else if (interface.info.currentPage == "whoweare")
			elementHtml += "Who we are";
		else if (interface.info.currentPage == "account")
			elementHtml += "Account Page";
	}
	else if (data.element == "footer")
	{
		elementHtml += "Hackathon Carrefour by BeMyApp 2016 &copy; - MySmartList &copy;";
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