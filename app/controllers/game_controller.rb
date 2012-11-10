class GameController < ApplicationController
  def index
    if user_signed_in?
      game = Savegame.where("uid == #{current_user.uid}").order('timestamp DESC').limit(1)
      respond_to do |format|
        format.json { render :json => game}
      end
    end
  end

  def save
    if user_signed_in?
      Savegame.create!(:gamestate => params[:gamestate], :hypetime => params[:hypertime], :uid => current_user.uid)
    end
  end
end