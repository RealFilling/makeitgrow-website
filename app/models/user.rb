class User < ActiveRecord::Base
  # Include default devise modules. Others available are:
  # :token_authenticatable, :confirmable,
  # :lockable, :timeoutable and :omniauthable
  # devise :database_authenticatable, :registerable,
  #       :recoverable, :rememberable, :trackable, :validatable
  devise :omniauthable, :trackable

  # Setup accessible (or protected) attributes for your model
  attr_accessible :email, :password, :provider, :uid, :password_confirmation, :remember_me
  # attr_accessible :title, :body

  # Game Related attributes (subject to change after refactor)
  has_many :authentications

  def apply_omniauth(auth)
    # In previous omniauth, 'user_info' was used in place of 'raw_info'
    self.email = auth['extra']['raw_info']['email']
    self.name = auth['extra']['raw_info']['name']
    self.first_name = auth['extra']['raw_info']['first_name']
    self.last_name = auth['extra']['raw_info']['last_name']
    self.username = auth['extra']['raw_info']['username']
    self.location = auth['extra']['raw_info']['location']['name']
    self.timezone = auth['extra']['raw_info']['timezone']
    # Again, saving token is optional. If you haven't created the column in authentications table, this will fail
    authentications.build(:provider => auth['provider'], :uid => auth['uid'], :token => auth['credentials']['token'])
  end
end
