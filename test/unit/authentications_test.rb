require 'test_helper'

class AuthenticationsTest < ActiveSupport::TestCase
  def test_should_be_valid
    assert Authentications.new.valid?
  end
end
