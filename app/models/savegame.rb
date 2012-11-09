class Savegame < ActiveRecord::Base
  attr_accessible :gamestate, :hypertime, :uid
end
