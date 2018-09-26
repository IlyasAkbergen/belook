<?php

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/verify/{token}', 'VerifyController@verify')->name('verify');

Route::get('office', 'OfficeController@mysettings')->name('office'); // во многих ссылках уже office написано было прост ... 	

Route::get('mysettings', 'OfficeController@mysettings')->name('mysettings');

Route::get('myreviews', 'OfficeController@myreviews')->name('myreviews');

Route::get('mygoods', 'OfficeController@mygoods')->name('mygoods');

Route::get('/home', function () {
    return redirect('/');
});

Route::get('good/{good_id}', 'GoodController@show');

Route::post('addgood', 'GoodController@store')->name('addgood');

Route::get('addGoodForm', function(){
	if( !Auth::guest() ){
		return view('addgood');
	}else{
		return redirect('/');
	}
})->name('addGoodForm');

Route::get('editGoodForm/{good_id}', 'OfficeController@editGoodForm');
Route::post('addPhoto', 'GoodPhotoController@store')->name('addPhoto');

Route::post('editTitle', 'GoodController@editTitle')->name('editTitle');

Route::post('editPrice', 'GoodController@editPrice')->name('editPrice');

Route::post('editDescription', 'GoodController@editDescription')->name('editDescription');

Route::post('editCategory', 'GoodController@editCategory')->name('editCategory');

Route::post('delPhoto', 'GoodPhotoController@delete')->name('delPhoto');

Route::get('shop', 'GoodController@shop')->name('shop');

Route::post('searchgood', 'GoodController@search')->name('searchgood');

Route::get('category/{id}', 'GoodController@category');

Route::post('rate', 'ReviewController@rate')->name('rate');

Route::get('deleteGood/{good_id}', 'GoodController@delete');

Route::get('myProfile', 'ProfileController@myProfile')->name('myProfile'); 

Route::get('profile/{id}', 'ProfileController@profile');

Route::get('profileAbout/{id}', 'ProfileController@profileAbout');

Route::get('profileReviews/{id}', 'ProfileController@profileReviews');

Route::get('profileContacts/{id}', 'ProfileController@profileContacts');

Route::post('editName', 'ProfileController@editName')->name('editName');

Route::post('editAddress', 'ProfileController@editAddress')->name('editAddress');

Route::post('uploadAva', 'ProfileController@uploadAva')->name('uploadAva');

Route::get('activateAccount', function(){
	return view('activateAccount');
})->name('activateAccount');

Route::get('addToCart/{good_id}', "CartController@add")->name('addToCart');

Route::get('deleteCart/{cart_id}', "CartController@delete")->name('deleteCart');

Route::post('uploadGoods', 'GoodController@uploadFromExcel')->name('uploadGoods');