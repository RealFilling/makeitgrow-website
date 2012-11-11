MakeitgrowWebsite::Application.routes.draw do
  
  match "game" => "game#index"
  
  devise_for :users, path_names: {sign_in: "login", sign_out: "logout"},
                     controllers: {omniauth_callbacks: "omniauth_callbacks"}
  root :to => "home#index"

end
