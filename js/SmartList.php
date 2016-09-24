
var interface = {};

interface.elements = {};

interface.info = {};
interface.info.currentPage = "home";

interface.navigate = function(data)
{
	interface.info.currentPage = data.page;
	interface.render();
}

interface.info.menuOpened = 0;
interface.menu = function()
{
	if (interface.info.menuOpened == 0)
	{
		//open menu
	}
	else
	{
		//close menu
	}
}

interface.compose = function(data)
{
	var elementHtml = "";
	if (data.element == "menu")
	{
		elementHtml += "<div id=\"menu\">";
			elementHtml += "<div onclick=\"interface.navigate({'page':'home'})\">Home</div>";
			elementHtml += "<div onclick=\"interface.navigate({'page':'account'})\">Account</div>";
			elementHtml += "<div onclick=\"interface.navigate({'page':'setting'})\">Setting</div>";
		elementHtml += "</div>";
	}
	else if (data.element == "menu-bar")
	{
		elementHtml += "<div id=\"menu-bar\">";
			elementHtml += "<div onclick=\"interface.navigate({'page':'home'})\">Logo</div>";
			elementHtml += "<div onclick=\"interface.menu()\">Menu</div>";
		elementHtml += "</div>";
	}
	else if (data.element == "mainView")
	{
		if (interface.info.currentPage == "home")
		{
			elementHtml += "My Smart List :";
		}
		else if (interface.info.currentPage == "settings")
			elementHtml += "MySmartList Settings";
	}
	else if (data.element == "footer")
	{
		elementHtml += "Hackathon Carrefour by BeMyApp 2016 &copy; - MySmartList &copy;";
	}
	return element;
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
	getElementById('menu').innerHTML = interface.elements.menu;
	getElementById('menu-bar').innerHTML = interface.elements.menuBar;
	getElementById('mainView').innerHTML = interface.elements.mainView;
	getElementById('footer').innerHTML = interface.elements.footer;
}

interface.construct = function()
{
	var menu = document.createElement("div");
	menu.id = "menu";
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