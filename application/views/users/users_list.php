<div id="page-wrapper" >
  <div class="page-content">
  <section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <h2 style="margin-top:0px"><?php echo $title ?></h2>
    <div class="row" style="margin-bottom: 10px">
      <div class="col-md-4">
        <?php if(xyzAccesscontrol('user_managment','Add')==TRUE){
        echo anchor(site_url('users/create'),'Create', 'class="btn btn-primary"');
        } ?>
      </div>
      <div class="col-md-4 text-center">
        <div style="margin-top: 8px" id="message">
          <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        </div>
      </div>
      <div class="col-md-4 text-right">
        <div>
          <div>
            <?php echo anchor(site_url('users/'), 'Go Back', 'class="btn btn-primary pull-right" style="margin-left: 2px;margin-bottom: 5px;"'); ?>
          </div>
          <?php if(xyzAccesscontrol('user_managment','Excel')==TRUE){
          echo anchor(site_url('users/excel'), 'Excel', 'class="btn btn-primary"');
          } ?>
          <?php if(xyzAccesscontrol('user_managment','Word')==TRUE){
          echo anchor(site_url('users/word'), 'Word', 'class="btn btn-primary"');
          }?>
        </div>
      </div>
    </div>
    <table id="mytable" class="table table-bordered table-striped" style="margin-bottom: 10px">
      <thead>
        <tr>
          <th>Sr. #</th>
          <th>Username</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
		   <th>State</th>
		    <th>City</th>
          <?php if(xyzAccesscontrol('user_managment','Status')==TRUE){ ?>
          <th>Status</th>
          <?php } ?>
          <th>Created <br/>Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $start=0;
        foreach ($users_data as $users)
        {
        ?>
        <tr>
          <td><?php echo ++$start; ?></td>
          <td><?php echo $users->username ?></td>
          <td><?php echo $users->userFirstName ?></td>
          <td><?php echo $users->userLastName ?></td>
          <td><?php echo $users->userEmail ?></td>
		   <td><?php echo $users->state ?></td>
		    <td><?php echo $users->city ?></td>
          <?php if(xyzAccesscontrol('user_managment','Status')==TRUE){ ?>
          <td>
            <?php
            if($users->userStatus==0)
            echo '<a href="'.site_url().'users/list_all/00">Unverified User</a>';
            elseif($users->userStatus==1)
            echo '<a href="'.site_url().'users/list_all/1">Active User</a>';
            elseif($users->userStatus==2)
            echo '<a href="'.site_url().'users/list_all/2">Suspended</a>';
                    /*                      elseif($users->userStatus==3)
            echo '<a href="'.site_url().'users/list_all/3"></a>';*/
            else echo "Undefined"
            ?>
          </td>
          <?php } ?>
          <td><?php $date = date_create($users->userCreationDate); echo date_format($date, 'm-d-Y'); ?></td>
          <td style="text-align:center" width="200px">
            <?php
            if(xyzAccesscontrol('user_managment','Read')==TRUE){
            echo '<a style="margin:2px;" class="btn btn-primary" href="'.site_url('users/read/'.$users->userId).'"  data-toggle="tooltip" title="View" ><i class="fa fa-bars"></i></a>';
            }if(xyzAccesscontrol('user_managment','Edit')==TRUE){
            echo '<a style="margin:2px;" class="btn btn-warning" href="'.site_url('users/update/'.$users->userId).'" data-toggle="tooltip" title="update" ><i class="fa fa-pencil"></i></a>';
            }if(xyzAccesscontrol('user_managment','Delete')==TRUE){
            echo '<a style="margin:2px;" class="btn btn-danger" href="'.site_url('users/delete/'.$users->userId).'" data-toggle="tooltip" title="Delete" onclick="javasciprt: return confirm(\'Are You Sure ?\')"><i class="fa fa-times"></i></a>';
            }
            if(xyzAccesscontrol('user_managment','Reset')==TRUE){?>
            <a class="btn btn-default" data-toggle="modal" data-target="#<?= $users->userId ?>">Reset</a>
            <?php } ?>
          </td>
        </tr>
        <div id="<?= $users->userId ?>" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Password</h4>
              </div>
              <div class="modal-body">
                <form class="form-inline" action="/frontend/password_reset" method="post" accept-charset="utf-8">
                  <label for="">Reset Password</label>
                  <input class="form-control" type="text" name="password" value="<?php echo substr(md5(time()), -8); ?>" placeholder="Enter Password">
                  <br>
                  <input type="hidden" value="<?php echo $users->userId ?>" name="id" placeholder="">
                  <input type="hidden" value="<?php echo $users->userEmail ?>" name="email" placeholder="">
                  <input type="submit" name="reset" value="Reset"  class="btn btn-danger">
                  <input type="submit" name="reset" value="Reset and Mail"  class="btn btn-danger">
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>