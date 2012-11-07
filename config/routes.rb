MakeitgrowWebsite::Application.routes.draw do
  root :to => "home#index"
  match 'game' => "game#index"

  resources :authentications

  devise_for :users
end
