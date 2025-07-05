
var myearth;
var localNewsMarker;
var news = [];

window.addEventListener( "earthjsload", function() {

	myearth = new Earth( document.getElementById('element'), {

		location : {lat: 20, lng: 78},
		zoom: 1.05,
		//light: 'none',
		transparent : false,	
		mapSeaColor : 'RGBA(204,204,204,0.95)',
		mapLandColor : '#FFFFFF',
		mapBorderColor : 'RGBA(204,204,204,0.90)',
		mapBorderWidth : 0.25,
		autoRotate: true,
		autoRotateSpeed: 0.7,
		autoRotateDelay: 4000,
		//mapStyles : ' #IN, #AU { fill: red; stroke: red; } ',
	});


	myearth.addEventListener( "ready", function() {

		this.startAutoRotate();


		// INDIA
		news[0] = myearth.addOverlay({
			location: {lat: 20, lng: 78},
			offset: 0.3,
			depthScale : 0.25,
			className : 'blue-pointer both-pointer asia-pin',
			occlude: true,
			newsId : 0 // custom property
		});

news[0].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip india');
$('<p>India</p>').appendTo('.india');
		});

news[0].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip india');
$(this).find('.blue-pointer p').remove()			
}); 


//China
news[0-2] = myearth.addOverlay( {
location: {lat: 35.8617, lng: 104.1954},
offset: 0.3,
depthScale : 0.26,
className : 'blue-pointer both-pointer asia-pin',
occlude: true,
newsId : 0-2 // custom property
});

news[0-2].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip chinaCountry');
$('<p>China</p>').appendTo('.chinaCountry');
});

news[0-2].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip chinaCountry');
$(this).find('.blue-pointer p').remove()			
}); 

//South Korea
news[0-3] = myearth.addOverlay( {
location: {lat: 35.9078, lng: 127.7669},
offset: 0.3,
depthScale : 0.26,
className : 'blue-pointer asia-pin',
occlude: true,
newsId : 0-3 // custom property
});

news[0-3].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip southkoreaCountry');
$('<p>South Korea</p>').appendTo('.southkoreaCountry');
});

news[0-3].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip southkoreaCountry');
$(this).find('.blue-pointer p').remove()			
}); 


//taiwan
news[0-4] = myearth.addOverlay( {
location: {lat: 23.6978, lng: 120.9605},
offset: 0.3,
depthScale : 0.26,
className : 'blue-pointer asia-pin',
occlude: true,
newsId : 0-4 // custom property
});

news[0-4].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip taiwanCountry');
$('<p>Taiwan</p>').appendTo('.taiwanCountry');
});

news[0-4].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip taiwanCountry');
$(this).find('.blue-pointer p').remove()			
}); 

/* Myanmar */
news[0-5] = myearth.addOverlay( {
    location: {lat: 21.9162, lng: 95.9560},
    offset: 0.3,
    depthScale : 0.26,
    className : 'blue-pointer asia-pin',
    occlude: true,
    newsId : 0-5 // custom property
    });
    
    news[0-5].element.addEventListener( 'click', function(highlightBreakingNews){
    $(this).find('.blue-pointer').addClass('map-tooltip MyanmarCountry');
    $('<p>Myanmar</p>').appendTo('.MyanmarCountry');
    });
    
    news[0-5].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
    $(this).find('.blue-pointer').removeClass('map-tooltip MyanmarCountry');
    $(this).find('.blue-pointer p').remove()			
    }); 

    /* Vietnam */

    news[0-6] = myearth.addOverlay( {
        location: {lat: 14.0583, lng: 108.2772},
        offset: 0.3,
        depthScale : 0.26,
        className : 'blue-pointer asia-pin',
        occlude: true,
        newsId : 0-6 // custom property
        });
        
        news[0-6].element.addEventListener( 'click', function(highlightBreakingNews){
        $(this).find('.blue-pointer').addClass('map-tooltip VietnamCountry');
        $('<p>Vietnam</p>').appendTo('.VietnamCountry');
        });
        
        news[0-6].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
        $(this).find('.blue-pointer').removeClass('map-tooltip VietnamCountry');
        $(this).find('.blue-pointer p').remove()			
        }); 

/* Philippines */        
news[0-7] = myearth.addOverlay( {
    location: {lat: 12.8797, lng: 121.7740},
    offset: 0.3,
    depthScale : 0.26,
    className : 'blue-pointer asia-pin',
    occlude: true,
    newsId : 0-7 // custom property
    });
    
    news[0-7].element.addEventListener( 'click', function(highlightBreakingNews){
    $(this).find('.blue-pointer').addClass('map-tooltip PhilippinesCountry');
    $('<p>Philippines</p>').appendTo('.PhilippinesCountry');
    });
    
    news[0-7].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
    $(this).find('.blue-pointer').removeClass('map-tooltip PhilippinesCountry');
    $(this).find('.blue-pointer p').remove()			
    }); 

    /* Cambodia */
    news[0-8] = myearth.addOverlay( {
        location: {lat: 12.5657, lng: 104.9910},
        offset: 0.3,
        depthScale : 0.26,
        className : 'blue-pointer asia-pin',
        occlude: true,
        newsId : 0-8 // custom property
        });
        
        news[0-8].element.addEventListener( 'click', function(highlightBreakingNews){
        $(this).find('.blue-pointer').addClass('map-tooltip CambodiaCountry');
        $('<p>Cambodia</p>').appendTo('.CambodiaCountry');
        });
        
        news[0-8].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
        $(this).find('.blue-pointer').removeClass('map-tooltip CambodiaCountry');
        $(this).find('.blue-pointer p').remove()			
        });

/* Thailand */
news[0-9] = myearth.addOverlay( {
    location: {lat: 15.8700, lng: 100.9925},
    offset: 0.3,
    depthScale : 0.26,
    className : 'blue-pointer asia-pin',
    occlude: true,
    newsId : 0-9 // custom property
    });
    
    news[0-9].element.addEventListener( 'click', function(highlightBreakingNews){
    $(this).find('.blue-pointer').addClass('map-tooltip ThailandCountry');
    $('<p>Thailand</p>').appendTo('.ThailandCountry');
    });
    
    news[0-9].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
    $(this).find('.blue-pointer').removeClass('map-tooltip ThailandCountry');
    $(this).find('.blue-pointer p').remove()			
    });

  /* Indonesia */  
  news[0-10] = myearth.addOverlay( {
    location: {lat: 0.7893, lng: 113.9213},
    offset: 0.3,
    depthScale : 0.26,
    className : 'blue-pointer both-pointer asia-pin',
    occlude: true,
    newsId : 0-10 // custom property
    });
    
    news[0-10].element.addEventListener( 'click', function(highlightBreakingNews){
    $(this).find('.blue-pointer').addClass('map-tooltip IndonesiaCountry');
    $('<p>Indonesia</p>').appendTo('.IndonesiaCountry');
    });
    
    news[0-10].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
    $(this).find('.blue-pointer').removeClass('map-tooltip IndonesiaCountry');
    $(this).find('.blue-pointer p').remove()			
    });


/* Singapore */
news[0-11] = myearth.addOverlay( {
    location: {lat: 1.3521, lng: 103.8198},
    offset: 0.3,
    depthScale : 0.26,
    className : 'blue-pointer asia-pin',
    occlude: true,
    newsId : 0-11 // custom property
    });
    
    news[0-11].element.addEventListener( 'click', function(highlightBreakingNews){
    $(this).find('.blue-pointer').addClass('map-tooltip SingaporeCountry');
    $('<p>Singapore</p>').appendTo('.SingaporeCountry');
    });
    
    news[0-11].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
    $(this).find('.blue-pointer').removeClass('map-tooltip SingaporeCountry');
    $(this).find('.blue-pointer p').remove()			
    });


/* Malaysia */    
news[0-12] = myearth.addOverlay( {
    location: {lat: 4.2105, lng: 101.9758},
    offset: 0.3,
    depthScale : 0.26,
    className : 'blue-pointer asia-pin',
    occlude: true,
    newsId : 0-12 // custom property
    });
    
    news[0-12].element.addEventListener( 'click', function(highlightBreakingNews){
    $(this).find('.blue-pointer').addClass('map-tooltip MalaysiaCountry');
    $('<p>Malaysia</p>').appendTo('.MalaysiaCountry');
    });
    
    news[0-12].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
    $(this).find('.blue-pointer').removeClass('map-tooltip MalaysiaCountry');
    $(this).find('.blue-pointer p').remove()			
    });

/* END */



/* CSI Countries */

// Russia
news[1] = myearth.addOverlay({
location: {lat: 61.5240, lng: 105.3188},
offset: 0.3,
depthScale : 0.25,
className : 'blue-pointer both-pointer csi-pin',
occlude: true,
newsId : 1
});

news[1].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip RussiaCountries');
$('<p>Russia</p>').appendTo('.RussiaCountries');	
});

news[1].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip RussiaCountries');
$(this).find('.blue-pointer p').remove()			
}); 


// Kazakhstan
news[1-2] = myearth.addOverlay({
location: {lat: 48.0196, lng: 66.9237},
offset: 0.3,
depthScale : 0.25,
className : 'blue-pointer csi-pin',
occlude: true,
newsId : 1-2
});

news[1-2].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip kazakhstanCountries');
$('<p>Kazakhstan</p>').appendTo('.kazakhstanCountries');	
});

news[1-2].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip kazakhstanCountries');
$(this).find('.blue-pointer p').remove()			
}); 


// Ukraine
news[1-3] = myearth.addOverlay({
    location: {lat: 48.3794, lng: 31.1656},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer csi-pin',
    occlude: true,
    newsId : 1-3
    });
    
    news[1-3].element.addEventListener( 'click', function(highlightBreakingNews){
    $(this).find('.blue-pointer').addClass('map-tooltip UkraineCountries');
    $('<p>Ukraine</p>').appendTo('.UkraineCountries');	
    });
    
    news[1-3].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
    $(this).find('.blue-pointer').removeClass('map-tooltip UkraineCountries');
    $(this).find('.blue-pointer p').remove()			
    });



// Kyrgyzstan
news[1-4] = myearth.addOverlay({
    location: {lat: 41.2044, lng: 74.7661},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer csi-pin',
    occlude: true,
    newsId : 1-4
    });
    
    news[1-4].element.addEventListener( 'click', function(highlightBreakingNews){
    $(this).find('.blue-pointer').addClass('map-tooltip KyrgyzstanCountries');
    $('<p>Kyrgyzstan</p>').appendTo('.KyrgyzstanCountries');	
    });
    
    news[1-4].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
    $(this).find('.blue-pointer').removeClass('map-tooltip KyrgyzstanCountries');
    $(this).find('.blue-pointer p').remove()			
    });


// Uzbekistan
news[1-4] = myearth.addOverlay({
    location: {lat: 41.3775, lng: 41.3775},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer csi-pin',
    occlude: true,
    newsId : 1-4
    });
    
    news[1-4].element.addEventListener( 'click', function(highlightBreakingNews){
    $(this).find('.blue-pointer').addClass('map-tooltip UzbekistanCountries');
    $('<p>Uzbekistan</p>').appendTo('.UzbekistanCountries');	
    });
    
    news[1-4].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
    $(this).find('.blue-pointer').removeClass('map-tooltip UzbekistanCountries');
    $(this).find('.blue-pointer p').remove()			
    });
    /* END */


// Middle East


/* Dubai */

news[2] = myearth.addOverlay({
    location: {lat: 23, lng: 45},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer mid-E-pin',
    occlude: true,
    newsId : 2
    });
    
    news[2].element.addEventListener( 'click', function(highlightBreakingNews){
    $(this).find('.blue-pointer').addClass('map-tooltip DubaiCountries');
    $('<p>Saudi Arabia</p>').appendTo('.DubaiCountries');	
    });
    
    news[2].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
    $(this).find('.blue-pointer').removeClass('map-tooltip DubaiCountries');
    $(this).find('.blue-pointer p').remove()			
    }); 


    news[2] = myearth.addOverlay({
        location: {lat: 23, lng: 53},
        offset: 0.3,
        depthScale : 0.25,
        className : 'blue-pointer mid-E-pin',
        occlude: true,
        newsId : 2
        });
        
        news[2].element.addEventListener( 'click', function(highlightBreakingNews){
        $(this).find('.blue-pointer').addClass('map-tooltip TurkeyCountries');
        $('<p>UAE</p>').appendTo('.TurkeyCountries');	
        });
        
        news[2].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
        $(this).find('.blue-pointer').removeClass('map-tooltip TurkeyCountries');
        $(this).find('.blue-pointer p').remove()			
        }); 



/* END */


// Europe

/* Spain */
news[3] = myearth.addOverlay( {
			location: {lat: 40, lng: -3},
			offset: 0.3,
			depthScale : 0.25,
			className : 'blue-pointer Europe-pin',
			occlude: true,
			newsId : 3
		});
		

news[3].element.addEventListener( 'click', function(highlightBreakingNews){

$(this).find('.blue-pointer').addClass('map-tooltip SpainCountries');
$('<p>Spain</p>').appendTo('.SpainCountries');
		});

news[3].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip SpainCountries');
$(this).find('.blue-pointer p').remove()			
}); 



    /* Poland */

    news[3-4] = myearth.addOverlay({
        location: {lat: 51.9194, lng: 19.1451},
        offset: 0.3,
        depthScale : 0.25,
        className : 'blue-pointer Europe-pin',
        occlude: true,
        newsId : 3-4
        });
        
        news[3-4].element.addEventListener( 'click', function(highlightBreakingNews){
        $(this).find('.blue-pointer').addClass('map-tooltip PolandCountries');
        $('<p>Poland</p>').appendTo('.PolandCountries');	
        });
        
        news[3-4].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
        $(this).find('.blue-pointer').removeClass('map-tooltip PolandCountries');
        $(this).find('.blue-pointer p').remove()			
        }); 




  /* UK */

  news[3-5] = myearth.addOverlay({
    location: {lat: 53, lng: -2},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer Europe-pin',
    occlude: true,
    newsId : 3-5
    });
    
    news[3-5].element.addEventListener( 'click', function(highlightBreakingNews){
    $(this).find('.blue-pointer').addClass('map-tooltip UnitedKingdomCountries');
    $('<p>United Kingdom</p>').appendTo('.UnitedKingdomCountries');	
    });
    
    news[3-5].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
    $(this).find('.blue-pointer').removeClass('map-tooltip UnitedKingdomCountries');
    $(this).find('.blue-pointer p').remove()			
    });        


/* Netherlands */

news[3-6] = myearth.addOverlay({
    location: {lat: 52.1326, lng: 5.2913},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer Europe-pin',
    occlude: true,
    newsId : 3-6
    });
    
    news[3-6].element.addEventListener( 'click', function(highlightBreakingNews){
    $(this).find('.blue-pointer').addClass('map-tooltip NetherlandsCountries');
    $('<p>Netherlands</p>').appendTo('.NetherlandsCountries');	
    });
    
    news[3-6].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
    $(this).find('.blue-pointer').removeClass('map-tooltip NetherlandsCountries');
    $(this).find('.blue-pointer p').remove()			
    }); 



 /* Germany */

 news[3-7] = myearth.addOverlay({
    location: {lat: 51.1657, lng: 10.4515},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer Europe-pin',
    occlude: true,
    newsId : 3-7
    });
    
    news[3-7].element.addEventListener( 'click', function(highlightBreakingNews){
    $(this).find('.blue-pointer').addClass('map-tooltip GermanyCountries');
    $('<p>Germany</p>').appendTo('.GermanyCountries');	
    });
    
    news[3-7].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
    $(this).find('.blue-pointer').removeClass('map-tooltip GermanyCountries');
    $(this).find('.blue-pointer p').remove()			
    });

/* END */




// Africa

/* Brazil */
news[4] = myearth.addOverlay( {
    location: {lat: -28, lng: 25},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer Africa-pin',
    occlude: true,
    newsId : 4
});

news[4].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip SouthA-Country');
$('<p>South Africa</p>').appendTo('.SouthA-Country');
});

news[4].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip SouthA-Country');
$(this).find('.blue-pointer p').remove()			
}); 


/* Kenya */
news[4-33] = myearth.addOverlay( {
    location: {lat: 0.0236, lng: 37.9062},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer Africa-pin',
    occlude: true,
    newsId : 4-33
});

news[4-33].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip Kenya-Country');
$('<p>Kenya</p>').appendTo('.Kenya-Country');
});

news[4-33].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip Kenya-Country');
$(this).find('.blue-pointer p').remove()			
}); 


/* Egypt */
news[4-44] = myearth.addOverlay( {
    location: {lat: 26.8206, lng: 30.8025},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer both-pointer Africa-pin',
    occlude: true,
    newsId : 4-44
});

news[4-44].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip Egypt-Country');
$('<p>Egypt</p>').appendTo('.Egypt-Country');
});

news[4-44].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip Egypt-Country');
$(this).find('.blue-pointer p').remove()			
}); 



/* Nigeria */
news[4-55] = myearth.addOverlay( {
    location: {lat: 9.0820, lng: 8.6753},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer Africa-pin',
    occlude: true,
    newsId : 4-55
});

news[4-55].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip Nigeria-Country');
$('<p>Nigeria</p>').appendTo('.Nigeria-Country');
});

news[4-55].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip Nigeria-Country');
$(this).find('.blue-pointer p').remove()			
});



/* Nigeria */
news[4-66] = myearth.addOverlay( {
    location: {lat: 28.0339, lng: 1.6596},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer Africa-pin',
    occlude: true,
    newsId : 4-66
});

news[4-66].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip Algeria-Country');
$('<p>Algeria</p>').appendTo('.Algeria-Country');
});

news[4-66].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip Algeria-Country');
$(this).find('.blue-pointer p').remove()			
});




/* END */

// Caribbean
news[5] = myearth.addOverlay( {
    location: {lat: 23, lng: -78},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer caribbean-pin',
    occlude: true,
    newsId : 5
});

news[5].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip CaribbeanCountry');
$('<p>Caribbean</p>').appendTo('.CaribbeanCountry');
});

news[5].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip CaribbeanCountry');
$(this).find('.blue-pointer p').remove()			
}); 

/* END */


// Australia
news[6] = myearth.addOverlay( {
    location: {lat: -23, lng: 130},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer Australia-pin',
    occlude: true,
    newsId : 6
});

news[6].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip AustraliaCountry');
$('<p>Australia</p>').appendTo('.AustraliaCountry');
});

news[6].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip AustraliaCountry');
$(this).find('.blue-pointer p').remove()			
}); 

/* END */

// North America
news[7] = myearth.addOverlay( {
    location: {lat: 60, lng: -120},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer North-America-pin',
    occlude: true,
    newsId : 7
});

news[7].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip CanadaCountry');
$('<p>Canada</p>').appendTo('.CanadaCountry');
});

news[7].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip CanadaCountry');
$(this).find('.blue-pointer p').remove()			
}); 


news[7-77] = myearth.addOverlay( {
    location: {lat: 45, lng: -105},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer both-pointer North-America-pin',
    occlude: true,
    newsId : 7-77
});

news[7-77].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip UsaCountry');
$('<p>USA</p>').appendTo('.UsaCountry');
});

news[7-77].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip UsaCountry');
$(this).find('.blue-pointer p').remove()			
}); 

/* END */


/* Center America */

news[8] = myearth.addOverlay( {
    location: {lat: 23, lng: -102},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer both-pointer Central-America-pin',
    occlude: true,
    newsId : 8
});

news[8].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip MexicoCountry');
$('<p>Mexico</p>').appendTo('.MexicoCountry');
});

news[8].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip MexicoCountry');
$(this).find('.blue-pointer p').remove()			
});


news[8-111] = myearth.addOverlay( {
    location: {lat: 17, lng: -91},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer Central-America-pin',
    occlude: true,
    newsId : 8-111
});

news[8-111].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip GuatemalaCountry');
$('<p>Guatemala</p>').appendTo('.GuatemalaCountry');
});

news[8-111].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip GuatemalaCountry');
$(this).find('.blue-pointer p').remove()			
});


news[8-222] = myearth.addOverlay( {
    location: {lat: 17, lng: -87},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer Central-America-pin',
    occlude: true,
    newsId : 8-222
});

news[8-222].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip HondurasCountry');
$('<p>Honduras</p>').appendTo('.HondurasCountry');
});

news[8-222].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip HondurasCountry');
$(this).find('.blue-pointer p').remove()			
});


news[8-333] = myearth.addOverlay( {
    location: {lat: 16, lng: -89},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer Central-America-pin',
    occlude: true,
    newsId : 8-333
});

news[8-333].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip SalvadorCountry');
$('<p>El Salvador</p>').appendTo('.SalvadorCountry');
});

news[8-333].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip SalvadorCountry');
$(this).find('.blue-pointer p').remove()			
});


news[8-444] = myearth.addOverlay( {
    location: {lat: 14, lng: -86},
    offset: 0.3,
    depthScale : 0.30,
    className : 'blue-pointer Central-America-pin',
    occlude: true,
    newsId : 8-444
});

news[8-444].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip NicaraguaCountry');
$('<p>Nicaragua</p>').appendTo('.NicaraguaCountry');
});

news[8-444].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip NicaraguaCountry');
$(this).find('.blue-pointer p').remove()			
});



news[8-555] = myearth.addOverlay( {
    location: {lat: 11, lng: -83},
    offset: 0.3,
    depthScale : 0.35,
    className : 'blue-pointer Central-America-pin',
    occlude: true,
    newsId : 8-555
});

news[8-555].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip CostaCountry');
$('<p>Costa Rica</p>').appendTo('.CostaCountry');
});

news[8-555].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip CostaCountry');
$(this).find('.blue-pointer p').remove()			
});



news[8-666] = myearth.addOverlay( {
    location: {lat: 11, lng: -80},
    offset: 0.3,
    depthScale : 0.40,
    className : 'blue-pointer Central-America-pin',
    occlude: true,
    newsId : 8-666
});

news[8-666].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip PanamaCountry');
$('<p>Panama</p>').appendTo('.PanamaCountry');
});

news[8-666].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip PanamaCountry');
$(this).find('.blue-pointer p').remove()			
});

/* END */

/* South America */

/* Brazil */
news[9] = myearth.addOverlay( {
    location: {lat: -8, lng: -55},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer South-America-pin',
    occlude: true,
    newsId : 9
});

news[9].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip BrazilCountry');
$('<p>Brazil</p>').appendTo('.BrazilCountry');
});

news[9].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip BrazilCountry');
$(this).find('.blue-pointer p').remove()			
});



/* Colombia */
news[9-777] = myearth.addOverlay( {
    location: {lat: 4, lng: -72},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer South-America-pin',
    occlude: true,
    newsId : 9-777
});

news[9-777].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip ColombiaCountry');
$('<p>Colombia</p>').appendTo('.ColombiaCountry');
});

news[9-777].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip ColombiaCountry');
$(this).find('.blue-pointer p').remove()			
});


/* Ecuador */
news[9-888] = myearth.addOverlay( {
    location: {lat: 1, lng: -78},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer South-America-pin',
    occlude: true,
    newsId : 9-888
});

news[9-888].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip EcuadorCountry');
$('<p>Ecuador</p>').appendTo('.EcuadorCountry');
});

news[9-888].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip EcuadorCountry');
$(this).find('.blue-pointer p').remove()			
});


/* Peru */
news[9-999] = myearth.addOverlay( {
    location: {lat: -14, lng: -70},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer South-America-pin',
    occlude: true,
    newsId : 9-999
});

news[9-999].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip PeruCountry');
$('<p>Peru</p>').appendTo('.PeruCountry');
});

news[9-999].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip PeruCountry');
$(this).find('.blue-pointer p').remove()			
});


/* Paraguay */
news[9-112] = myearth.addOverlay( {
    location: {lat: -23, lng: -56},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer South-America-pin',
    occlude: true,
    newsId : 9-112
});

news[9-112].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip ParaguayCountry');
$('<p>Paraguay</p>').appendTo('.ParaguayCountry');
});

news[9-112].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip ParaguayCountry');
$(this).find('.blue-pointer p').remove()			
});



/* Chile */
news[9-113] = myearth.addOverlay( {
    location: {lat: -33, lng: -70},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer South-America-pin',
    occlude: true,
    newsId : 9-113
});

news[9-113].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip ChileCountry');
$('<p>Chile</p>').appendTo('.ChileCountry');
});

news[9-113].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip ChileCountry');
$(this).find('.blue-pointer p').remove()			
});



/* Venezuela */
news[9-114] = myearth.addOverlay( {
    location: {lat: 6, lng: -66},
    offset: 0.3,
    depthScale : 0.25,
    className : 'blue-pointer South-America-pin',
    occlude: true,
    newsId : 9-114
});

news[9-114].element.addEventListener( 'click', function(highlightBreakingNews){
$(this).find('.blue-pointer').addClass('map-tooltip VenezuelaCountry');
$('<p>Venezuela</p>').appendTo('.VenezuelaCountry');
});

news[9-114].element.addEventListener( 'mouseleave', function(highlightBreakingNews){
$(this).find('.blue-pointer').removeClass('map-tooltip VenezuelaCountry');
$(this).find('.blue-pointer p').remove()			
});






	/* 	 myearth.addMarker({
			location: {lat: 3.52, lng: 97.3},
			mesh : "Pin3",
			color : "red",
			scale: 0.4,
			hotspot: false,
		}); */ 
		
		
	});
	
	
	
	var selectedCountry;
	
	myearth.addEventListener( 'click', function( event ) {
			
	} );
	
} );


function highlightBreakingNews( event ) {

	var overlay = event.target.closest('.earth-overlay').overlay;
	var newsId = overlay.newsId;
	
	document.getElementById( 'breaking-news-'+ newsId ).classList.add( 'news-highlight' );
	setTimeout( function(){
		document.getElementById( 'breaking-news-'+ newsId ).classList.remove( 'news-highlight' );
	}, 500 );
	
	myearth.goTo( overlay.location, { duration: 250, relativeDuration: 70 } );
	
	event.stopPropagation();
}

function gotoBreakingNews( newsId ) {

	myearth.goTo( news[ newsId ].location, { duration: 250, relativeDuration: 70 } );
	
}


/* $('.countries-tabs h3').click(function(){
    $('.countries-tabs .news').removeClass('active-tabs');
    $(this).find('.countries-tabs .news').addClass('active-tabs')
    }) */


$('#breaking-news-0 h3').click(function(){
$('.blue-pointer').removeClass('pin-active');
$('.pruple-pointer').removeClass('pin-active');
$('.asia-pin').addClass('pin-active')
}) 


$('#breaking-news-1 h3').click(function(){
$('.blue-pointer').removeClass('pin-active');
$('.pruple-pointer').removeClass('pin-active');
$('.csi-pin').addClass('pin-active')
})


$('#breaking-news-2 h3').click(function(){
$('.blue-pointer').removeClass('pin-active');
$('.pruple-pointer').removeClass('pin-active');
$('.mid-E-pin').addClass('pin-active')
})

$('#breaking-news-3 h3').click(function(){
$('.blue-pointer').removeClass('pin-active');
$('.pruple-pointer').removeClass('pin-active');
$('.Europe-pin').addClass('pin-active')
})

$('#breaking-news-4 h3').click(function(){
$('.blue-pointer').removeClass('pin-active');
$('.pruple-pointer').removeClass('pin-active');
$('.Africa-pin').addClass('pin-active')
})

$('#breaking-news-5 h3').click(function(){
$('.blue-pointer').removeClass('pin-active');
$('.pruple-pointer').removeClass('pin-active');
$('.caribbean-pin').addClass('pin-active')
})


$('#breaking-news-6 h3').click(function(){
$('.blue-pointer').removeClass('pin-active');
$('.pruple-pointer').removeClass('pin-active');
$('.Australia-pin').addClass('pin-active')
})

$('#breaking-news-7 h3').click(function(){
$('.blue-pointer').removeClass('pin-active');
$('.pruple-pointer').removeClass('pin-active');
$('.North-America-pin').addClass('pin-active')
})

$('#breaking-news-8 h3').click(function(){
$('.blue-pointer').removeClass('pin-active');
$('.pruple-pointer').removeClass('pin-active');
$('.Central-America-pin').addClass('pin-active')
})


$('#breaking-news-9 h3').click(function(){
$('.blue-pointer').removeClass('pin-active');
$('.pruple-pointer').removeClass('pin-active');
$('.South-America-pin').addClass('pin-active')
})
