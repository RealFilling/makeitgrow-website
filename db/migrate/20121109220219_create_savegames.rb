class CreateSavegames < ActiveRecord::Migration
  def change
    create_table :savegames do |t|
      t.string :uid
      t.string :gamestate
      t.integer :hypertime

      t.timestamps
    end
  end
end
