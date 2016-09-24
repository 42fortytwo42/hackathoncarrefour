
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

interface.productsDisplayCheckDouble = function(product, productList)
{
	var double = 0;
	for (var e = 0; productList[e]; e++)
	{
		if (productList[e].id == product.id)
		{
			double = 1;
			break;
		}
	}
	return double;
}

interface.productsDisplay = function(data)
{
	var productsList = [];
	for (var i = 0; interface.data.profile.lists[i]; i++)
	{
		for (var z = 0; interface.data.profile.lists[i].products[z]; z++)
		{
			if (interface.productsDisplayCheckDouble(interface.data.profile.lists[i].products[z], productsList) == 0)
			{
				//set color with probability
				var probabilityRGBATransparency = interface.data.profile.lists[i].products[z].probability / 100;
				interface.data.profile.lists[i].products[z].probabilityRGBA = "rgba(" + interface.data.profile.probabilityColor.r + "," + interface.data.profile.probabilityColor.g + "," + interface.data.profile.probabilityColor.b + "," + probabilityRGBATransparency + ")";
				productsList.push(interface.data.profile.lists[i].products[z]);
			}
		}
	}
	productsList.sort(function (a, b){
	    if (a.probability < b.probability)
	      return 1;
	    if (a.probability > b.probability)
	      return -1;
	    return 0;
	});

	//générer le template.
	var productsListHtml = "";
	for (var j = 0; productsList[j]; j++)
	{
		console.log("probability => " + productsList[j].probability + " limite => " + interface.data.profile.probabilityLimit);
		if (productsList[j].probability >= interface.data.profile.probabilityLimit)
			var inputCheckBox = "<input type=\"checkbox\" name=\"product\" value=\"" + productsList[j].id + "\" checked>";
		else
			var inputCheckBox = "<input type=\"checkbox\" name=\"product\" value=\"" + productsList[j].id + "\">";
		productsListHtml += "<div class=\"product-line\" style=\"background:" + productsList[j].probabilityRGBA + "\"><div class=\"product-checkbox\">" + inputCheckBox + "</div><div class=\"product-name\">" + productsList[j].name + "</div></div>";
	}
	if (productsList.length > 0)
		return productsListHtml;
	else
		return "No data to analyze yet";
	//placer le background de couleur
	//selectionner automatiquement les données supérieures à la moyenne de l'utilisateur
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
			elementHtml += "<div id=\"main-content\">";
				elementHtml += interface.productsDisplay({option:'probability'});
			elementHtml += "</div>";
			elementHtml += interface.shortcuts();
		}
		else if (interface.info.currentPage == "settings")
		{
			elementHtml += interface.pageTitle({title:'Settings'});
			elementHtml += "<div id=\"main-content\">";

			elementHtml += "</div>";
		}
		else if (interface.info.currentPage == "whoweare")
		{
			elementHtml += interface.pageTitle({title:'Who We Are !'});
			elementHtml += "<div id=\"main-content\">";

			elementHtml += "</div>";
		}
		else if (interface.info.currentPage == "account")
		{
			elementHtml += interface.pageTitle({title:'User Account'});
			elementHtml += "<div id=\"main-content\">";
				elementHtml += "<div class=\"lineDivideTwo\">";
					elementHtml += "<div class=\"line\">";
						elementHtml += "<div class=\"line-title\">Lastname</div>";
						elementHtml += "<div class=\"line-data\">" + interface.data.profile.lastname + "</div>";
					elementHtml += "</div>";
					elementHtml += "<div class=\"line\">";
						elementHtml += "<div class=\"line-title\">Firstname</div>";
						elementHtml += "<div class=\"line-data\">" + interface.data.profile.firstname + "</div>";
					elementHtml += "</div>";
					elementHtml += "<div class=\"line\">";
						elementHtml += "<div class=\"line-title\">Birthdate</div>";
						elementHtml += "<div class=\"line-data\">" + interface.data.profile.birthdate + "</div>";
					elementHtml += "</div>";
					elementHtml += "<div class=\"line\">";
						elementHtml += "<div class=\"line-title\">Sexe</div>";
						elementHtml += "<div class=\"line-data\">" + interface.data.profile.sexe + "</div>";
					elementHtml += "</div>";
				elementHtml += "</div>";
				elementHtml += "<div class=\"lineDivideTwo\">";
					elementHtml += "<div class=\"line\">";
						elementHtml += "<div class=\"line-title\">Avatar</div>";
						elementHtml += "<div class=\"line-data\"><img class=\"\" src=\"" + interface.data.profile.avatar + "\"></div>";
					elementHtml += "</div>";
					elementHtml += "<div class=\"line\">";
						elementHtml += "<div class=\"line-title\">Lists Total</div>";
						elementHtml += "<div class=\"line-data\">" + interface.data.profile.lists.length + "</div>";
					elementHtml += "</div>";
				elementHtml += "</div>";
			elementHtml += "</div>";
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
		"probabilityLimit": 55,
		"probabilityColor": {
			"r": 17,
			"g": 237,
			"b": 46
		},
		"lists": [{
			"dateCreation": "23-09-2016",
			"shared": "0",
			"price": 4.77,
			"products": [{
				"id": "044016223",
				"name": "Haricots Verts",
				"price": 0.98,
				"img": "haricots.jpg",
				"probability": 88,
				"promo": 1
			}, {
				"id": "049849681",
				"name": "Shampoing l'Oréal",
				"price": 2.48,
				"img": "shampoing.jpg",
				"probability": 69,
				"promo": 1
			}, {
				"id": "098465665",
				"name": "Café Décaféiné",
				"price": 2.31,
				"img": "cafe.jpg",
				"probability": 48,
				"promo": 1
			}, {
				"id": "09846566578",
				"name": "Café Caféiné",
				"price": 2.31,
				"img": "cafe.jpg",
				"probability": 18,
				"promo": 1
			}, {
				"id": "09846566755",
				"name": "Préservatifs",
				"price": 12.31,
				"img": "cafe.jpg",
				"probability": 98,
				"promo": 1
			}, {
				"id": "09846565865",
				"name": "Sucettes",
				"price": 5.87,
				"img": "cafe.jpg",
				"probability": 28,
				"promo": 1
			}]
		}]
	}
};


/*

function hexToR(h) {return parseInt((cutHex(h)).substring(0,2),16)}
function hexToG(h) {return parseInt((cutHex(h)).substring(2,4),16)}
function hexToB(h) {return parseInt((cutHex(h)).substring(4,6),16)}

*/