class CreateSavegames < ActiveRecord::Migration
  def change
    create_table :savegames do |t|
      t.string :uid
      t.string :gamestate
      t.number :hypertime

      t.timestamps
    end
  end
end
