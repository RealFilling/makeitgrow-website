MakeitgrowWebsite::Application.routes.draw do
  root :to => "home#index"
  match 'game' => "home#game"

  devise_for :users
end
