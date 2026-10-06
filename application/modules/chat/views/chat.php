<link href="common/extranal/css/chat.css" rel="stylesheet">

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-comments mr-2 text-primary"></i>
                        <?php echo lang('chat'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('chat') ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row h-100">
                <div class="col-12">
                    <div class="card chat-container">
                        <div class="card-header chat-header">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-users mr-2"></i>
                                <?php echo lang('Chat between all the staffs'); ?>
                            </h3>
                            <div class="chat-status">
                                <span class="badge badge-success">
                                    <i class="fas fa-circle pulse"></i> Online
                                </span>
                            </div>
                        </div>
                        
                        <div class="card-body p-0 chat-main">
                            <div class="row no-gutters h-100">
                                <!-- Chat Sidebar -->
                                <div class="col-md-4 col-lg-3 chat-sidebar">
                                    <div class="chat-search">
                                        <div class="search-wrapper">
                                            <i class="fas fa-search search-icon"></i>
                                            <input type="text" id="searchChat" class="form-control search-input" placeholder="Search conversations...">
                                        </div>
                                    </div>
                                    
                                    <div class="chat-list" id="chattersBlock">
                                        <!-- Admin Section -->
                                        <div class="chat-section">
                                            <div class="section-header">
                                                <i class="fas fa-user-shield mr-2"></i>
                                                <?php echo lang('admin'); ?>
                                            </div>
                                            <div id="adminChatters">
                                                <?php for ($i = 0; $i < count($admins); $i++) {
                                                    if ($current_user != $admins[$i]['id']) { ?>
                                                        <div class="chat-user <?php if ($receiver_id == $admins[$i]['id']) { ?>active<?php } else if ($admins[$i]['newChat'] == 'unread') { ?>unread<?php } ?>" data-id="<?php echo $admins[$i]['id']; ?>">
                                                            <div class="user-avatar">
                                                                <i class="fas fa-user-shield"></i>
                                                                <span class="status-indicator online"></span>
                                                            </div>
                                                            <div class="user-info">
                                                                <div class="user-name"><?php echo $admins[$i]['username']; ?></div>
                                                                <div class="user-status">Administrator</div>
                                                            </div>
                                                            <?php if ($admins[$i]['newChat'] == 'unread') { ?>
                                                                <div class="unread-badge">
                                                                    <span class="badge badge-primary">•</span>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                <?php }
                                                } ?>
                                            </div>
                                        </div>
                                        
                                        <!-- Employee Section -->
                                        <div class="chat-section">
                                            <div class="section-header">
                                                <i class="fas fa-users mr-2"></i>
                                                <?php echo lang('employee'); ?>
                                            </div>
                                            <div id="employeeChatters">
                                                <?php for ($i = 0; $i < count($employeeChat); $i++) {
                                                    if ($current_user != $employeeChat[$i]['ion_user_id']) { ?>
                                                        <div class="chat-user <?php if ($receiver_id == $employeeChat[$i]['ion_user_id']) { ?>active<?php } else if ($employeeChat[$i]['newChat'] == 'unread') { ?>unread<?php } ?>" data-id="<?php echo $employeeChat[$i]['ion_user_id']; ?>">
                                                            <div class="user-avatar">
                                                                <i class="fas fa-user"></i>
                                                                <span class="status-indicator online"></span>
                                                            </div>
                                                            <div class="user-info">
                                                                <div class="user-name"><?php echo $employeeChat[$i]['name']; ?></div>
                                                                <div class="user-status">Staff Member</div>
                                                            </div>
                                                            <?php if ($employeeChat[$i]['newChat'] == 'unread') { ?>
                                                                <div class="unread-badge">
                                                                    <span class="badge badge-primary">•</span>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                <?php }
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Chat Area -->
                                <div class="col-md-8 col-lg-9 chat-area">
                                    <!-- Chat Header -->
                                    <div class="chat-area-header">
                                        <div class="chat-user-info">
                                            <div class="user-avatar-small">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div class="user-details">
                                                <div class="chat-username"><?php echo $user; ?></div>
                                                <div class="user-activity">
                                                    <span class="status-dot online"></span>
                                                    <span class="activity-text">Online</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat-actions">
                                            <button class="btn btn-sm btn-outline-secondary" title="More options">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Chat Messages -->
                                    <div class="chat-messages" id="chatBox">
                                        <?php echo $chats; ?>
                                    </div>
                                    
                                    <!-- Typing Indicator -->
                                    <div class="typing-indicator" id="typingIndicator" style="display: none;">
                                        <div class="typing-dots">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <span class="typing-text">Someone is typing...</span>
                                    </div>
                                    
                                    <!-- Chat Input -->
                                    <div class="chat-input-area">
                                        <div class="input-wrapper">
                                            <a class="btn btn-link attachment-btn" title="Attach file">
                                                <i class="fas fa-paperclip"></i>
                                            </a>
                                            <input type="text" class="form-control chat-input" placeholder="Type your message..." maxlength="500">
                                            <div class="input-actions">
                                                <a class="btn btn-link emoji-btn" title="Add emoji">
                                                    <i class="fas fa-smile"></i>
                                            </a>
                                                <a class="btn btn-primary send-btn" title="Send message">
                                                    <i class="fas fa-paper-plane"></i>
                                            </a>
                                            </div>
                                        </div>
                                        <div class="message-info">
                                            <span class="character-count">0/500</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Hidden inputs -->
                                    <input type="hidden" id="receiverId" value="<?php echo $receiver_id; ?>">
                                    <input type="hidden" id="lastMessageId" value="<?php echo $lastMessageId; ?>">
                                    <input type="hidden" id="recentMessageId" value="<?php echo $recentMessageId; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Mobile Chat Toggle Button -->
    <button class="mobile-chat-toggle" title="Toggle chat list">
        <i class="fas fa-comments"></i>
    </button>
</div>










<!--main content end-->
<!--footer start-->


<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/chat_module.js"></script>